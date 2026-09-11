<?php
// api.php (Main Router)
header('Content-Type: application/json; charset=UTF-8');
include_once __DIR__ . '/bin/config.php';

$action = $_GET['action'] ?? '';

// Action එක අනුව අදාළ Controller එකට යොමු කිරීම
switch ($action) {
    case 'register_user':
    case 'login':
        // Auth සම්බන්ධ සියලු දේවල් auth_controller.php එකට යවයි
        require_once __DIR__ . '/app/controllers/auth_controller.php';
        break;

    case 'create_post':
    case 'get_posts':
        // අනාගතයේදී Posts සම්බන්ධ දේවල් මෙතනට යොමු කරමු
        // require_once __DIR__ . '/app/Controllers/post_controller.php';
        break;

    default:
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Invalid or missing action parameter.']);
        break;
}
exit;
?>