<?php
// api.php (Main Router)
header('Content-Type: application/json; charset=UTF-8');
include_once __DIR__ . '/bin/config.php';

$action = $_GET['action'] ?? '';

// Action එක අනුව අදාළ Controller එකට යොමු කිරීම
switch ($action) {
    case 'register_user':
    case 'login':
        // Auth සම්බන්ධ සියලු දේවල් auth_controller.php එකට යවයි[cite: 3]
        require_once __DIR__ . '/app/controllers/auth_controller.php';
        break;

    case 'logout':
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        session_unset();
        session_destroy();
        // Logout වූ පසු නැවත Home page එකට redirect කිරීම
        header("Location: index.php");
        exit;

    case 'create_post':
    case 'get_posts':
        // අනාගතයේදී Posts සම්බන්ධ දේවල් මෙතනට යොමු කරමු[cite: 3]
        // require_once __DIR__ . '/app/Controllers/post_controller.php';[cite: 3]
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid or missing action parameter.']);
        break;
}
exit;
?>