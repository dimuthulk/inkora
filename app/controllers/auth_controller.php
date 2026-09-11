<?php
/** 
 * @var string $action 
 * @var string $dsn
 * @var string $db_user
 * @var string $db_pass
 * @var array $options
 */
// app/Controllers/auth_controller.php

// $pdo connection එක හදාගැනීම
try {
    $pdo = new PDO($dsn, $db_user, $db_pass, $options);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Database connection failed.']);
    exit;
}

if ($action === 'register_user') {
    try {
        $input = json_decode(file_get_contents('php://input'), true);

        if (empty($input['firstName']) || empty($input['lastName']) || empty($input['email']) || empty($input['password'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
            exit;
        }

        $email = $input['email'];
        
        // Email පරීක්ෂාව
        $stmt = $pdo->prepare("SELECT id FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['status' => 'error', 'message' => 'This email address is already in use.']);
            exit;
        }

        $firstName = $input['firstName'];
        $lastName = $input['lastName'];
        $birthday = !empty($input['birthday']) ? $input['birthday'] : null;
        $country = $input['country'] ?? null;
        $passwordHash = password_hash($input['password'], PASSWORD_DEFAULT);
        
        // Public ID සෑදීම
        $publicId = generate_random_12char_id();

        $insertStmt = $pdo->prepare("INSERT INTO Users (public_id, firstName, lastName, birthday, email, passwordHash, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->execute([$publicId, $firstName, $lastName, $birthday, $email, $passwordHash, $country]);

        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Account created successfully.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
} 
elseif ($action === 'login') {
    try {
        $input = json_decode(file_get_contents('php://input'),true);
        // JSON වලින් හෝ Form Data වලින් එන දත්ත අල්ලා ගැනීම
        $email = trim($input['email'] ?? ($_POST['email'] ?? ''));
        $password = trim($input['password'] ?? ($_POST['password'] ?? ''));

        if(empty($email) || empty($password)) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
            exit;
        }

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch();

        if($user && password_verify($password, $user['passwordHash'])) {
            session_start();
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['email'] = $user['email'];
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Login successful.', 'user' => ['email' => $user['email']]]);
        } else {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
        }
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
}
?>