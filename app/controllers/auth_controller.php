<?php
header('Content-Type: application/json; charset=UTF-8');

include_once __DIR__ . '/../../bin/config.php';

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

function get_json_input() {
    $rawInput = file_get_contents('php://input');
    $input = json_decode($rawInput, true);

    if (!is_array($input)) {
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON payload.']);
        exit;
    }

    return $input;
}

function register_user() {
    try {
        $input = get_json_input();

        if (empty($input['firstName']) || empty($input['lastName']) || empty($input['email']) || empty($input['password'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
            return;
        }

        $firstName = trim($input['firstName']);
        $lastName = trim($input['lastName']);
        $birthday = !empty($input['birthday']) ? $input['birthday'] : null;
        $email = trim($input['email']);
        $country = $input['country'] ?? null;

        if ($firstName === '' || $lastName === '' || $email === '') {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Please fill in all required fields']);
            return;
        }

        $passwordHash = password_hash($input['password'], PASSWORD_DEFAULT);

        $pdo = new PDO($GLOBALS['dsn'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['options']);

        $stmt = $pdo->prepare("SELECT id FROM Users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->fetch()) {
            http_response_code(409);
            echo json_encode(['status' => 'error', 'message' => 'This email address is already in use.']);
            return;
        }

        $publicId = generate_random_12char_id();

        $insertStmt = $pdo->prepare("INSERT INTO Users (public_id, first_name, last_name, birthday, email, password_hash, country) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $insertStmt->execute([$publicId, $firstName, $lastName, $birthday, $email, $passwordHash, $country]);

        http_response_code(201);
        echo json_encode(['status' => 'success', 'message' => 'Account created successfully.']);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

function login_user() {
    try {
        $input = get_json_input();

        if (empty($input['email']) || empty($input['password'])) {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
            return;
        }

        $email = trim($input['email']);
        $password = $input['password'];

        if ($email === '') {
            http_response_code(400);
            echo json_encode(['status' => 'error', 'message' => 'Email and password are required.']);
            return;
        }

        $pdo = new PDO($GLOBALS['dsn'], $GLOBALS['db_user'], $GLOBALS['db_pass'], $GLOBALS['options']);

        $stmt = $pdo->prepare("SELECT * FROM Users WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password_hash'])) {
            http_response_code(401);
            echo json_encode(['status' => 'error', 'message' => 'Invalid email or password.']);
            return;
        }

        $_SESSION['user_id'] = $user['id'];
        $_SESSION['email'] = $user['email'];

        http_response_code(200);
        echo json_encode([
            'status' => 'success',
            'message' => 'Login successful.',
            'user' => ['email' => $user['email']]
        ]);
    } catch (PDOException $e) {
        http_response_code(500);
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
}

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'register_user':
        register_user();
        break;

    case 'login':
        login_user();
        break;

    default:
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'Invalid or missing action parameter.'
        ]);
        break;
}

exit;
