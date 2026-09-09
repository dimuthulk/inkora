<?php
// api.php
header('Content-Type: application/json; charset=UTF-8');

// Include your database configuration
include_once __DIR__ . '/bin/config.php';

// Determine the requested action from query string
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register_user':
        try {
            // Get JSON data sent from the frontend
            $input = json_decode(file_get_contents('php://input'), true);

            // Check if the required basic data has been provided
            if (empty($input['firstName']) || empty($input['lastName']) || empty($input['email']) || empty($input['password'])) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
                break;
            }

            $firstName = $input['firstName'];
            $lastName = $input['lastName'];
            $birthday = !empty($input['birthday']) ? $input['birthday'] : null;
            $email = $input['email'];
            $country = $input['country'] ?? null;

            // Hash the password (for security)
            $passwordHash = password_hash($input['password'], PASSWORD_DEFAULT);

            // Create the database connection
            $pdo = new PDO($dsn, $db_user, $db_pass, $options);

            // Check if the email already exists in the system
            $stmt = $pdo->prepare("SELECT id FROM Users WHERE email = ?");
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                http_response_code(409);
                echo json_encode(['status' => 'error', 'message' => 'This email address is already in use.']);
                break;
            }

            // Generate a Public ID using the company's function
            $publicId = generate_random_12char_id();

            // Adding a new user to the database
            $insertStmt = $pdo->prepare("INSERT INTO Users (public_id, firstName, lastName, birthday, email, passwordHash, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $insertStmt->execute([$publicId, $firstName, $lastName, $birthday, $email, $passwordHash, $country]);

            http_response_code(201);
            echo json_encode(['status' => 'success', 'message' => 'Account created successfully.']);

        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
        }
        break;

    case 'login':
        try{
            $pdo = new PDO($dsn, $db_user, $db_pass, $options);

            $input = json_decode(file_get_contents('php://input'),true);
            $email = trim($_POST['email'] ?? '');
            $password= trim($_POST['password'] ?? '');
            if(empty($email) || empty($password)) {
                http_response_code(400);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Email and password are required.'
                ]);
                exit;
            }

            $stmt = $pdo-> prepare("SELECT * FROM Users WHERE email = :email");
            $stmt->execute(['email' => $email]);
            $user = $stmt->fetch();

        

            if($user && password_verify($password, $user['passwordHash'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];

                http_response_code(200);
                echo json_encode([
                    'status'  => 'success',
                    'message' => 'Login successful.',
                    'user'    => ['email' => $user['email']]
                ]);
            } else {
                // Invalid credentials
                http_response_code(401);
                echo json_encode([
                    'status'  => 'error',
                    'message' => 'Invalid email or password.'
                ]);
            }
        } catch (PDOException $e) {
            http_response_code(500);
            echo json_encode([
                'status'  => 'error',
                'message' => 'Database error occurred: ' . $e->getMessage()
            ]);
        }
        break;

    default:
        http_response_code(400);
        echo json_encode([
            'status'  => 'error',
            'message' => 'Invalid or missing action parameter.'
        ]);
        break;
}
exit;
?>