<?php
session_start();
include '../model/pdo.php';

if (!empty($_POST['userData'])) {
    // Giải mã dữ liệu người dùng từ JSON thành mảng
    $userData = json_decode($_POST['userData'], true);

    // Kiểm tra xem dữ liệu người dùng đã tồn tại trong cơ sở dữ liệu chưa
    $prevQuery = "SELECT id FROM user WHERE facebook_id = ?";
    $stmt = $db_connection->prepare($prevQuery);
    $stmt->bind_param('s', $userData['id']);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Nếu dữ liệu người dùng đã tồn tại, cập nhật thông tin
        $query = "UPDATE user SET name = CONCAT(?, ' ', ?), email = ? WHERE facebook_id = ?";
        $stmt = $db_connection->prepare($query);
        $stmt->bind_param('ssss', $userData['first_name'], $userData['last_name'], $userData['email'], $userData['id']);
        $stmt->execute();

        // Đặt lại session user với thông tin cập nhật
        $_SESSION['user'] = array(
            'id' => $_SESSION['user']['id'],
            'facebook_id' => $userData['id'],
            'name' => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email']
        );
        header('Location: ../index.php');
    } else {
        // Nếu dữ liệu người dùng chưa tồn tại, thêm mới
        $query = "INSERT INTO user (facebook_id, name, email) VALUES (?, CONCAT(?, ' ', ?), ?)";
        $stmt = $db_connection->prepare($query);
        $stmt->bind_param('ssss', $userData['id'], $userData['first_name'], $userData['last_name'], $userData['email']);
        $stmt->execute();

        // Đặt lại session user với thông tin mới
        $_SESSION['user'] = array(
            'id' => $db_connection->insert_id,
            'facebook_id' => $userData['id'],
            'name' => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email']
        );
        header('Location: ../index.php');
    }

    header('Location: ../index.php');
    exit;
}
?>