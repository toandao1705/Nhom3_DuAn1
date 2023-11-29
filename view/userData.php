<?php 

include '../model/pdo.php';
 
if (!empty($_POST['userData'])) {
    // Giải mã dữ liệu người dùng từ JSON thành mảng
    $userData = json_decode($_POST['userData'], true);

    
    // Kiểm tra xem dữ liệu người dùng đã tồn tại trong cơ sở dữ liệu chưa
    $prevQuery = "SELECT id FROM user WHERE facebook_id = '".$userData['id']."'";
    $prevResult = $db_connection->query($prevQuery);
    
    
    if ($prevResult->num_rows > 0) {
        // Nếu dữ liệu người dùng đã tồn tại, lưu thông tin vào session và chuyển hướng đến trang home.php
        $query = "UPDATE user SET name = CONCAT('".$userData['first_name']."', ' ', '".$userData['last_name']."'), email = '".$userData['email']."' WHERE facebook_id = '".$userData['id']."'";
$update = $db_connection->query($query);
        
        $_SESSION['facebook'] = [
            'id' => $userData['id'],
            'name' => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email']
        ];
        $_SESSION['facebook'] = array(
            'id' => mysqli_insert_id($db_connection),
            'id' => $userData['id'],
            'name' => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email']
        ); // Lưu thông tin user vào session
        
        // header('Location: ../index.php');
        exit;
    } else {
        // Nếu dữ liệu người dùng chưa tồn tại, thêm dữ liệu vào cơ sở dữ liệu và lưu thông tin vào session, sau đó chuyển hướng đến trang home.php
        $query = "INSERT INTO user SET facebook_id = '".$userData['id']."', name = CONCAT('".$userData['first_name']."', ' ', '".$userData['last_name']."'), email = '".$userData['email']."'";
        $insert = $db_connection->query($query);
        
        $_SESSION['facebook'] = [
            'id' => $userData['id'],
            'name' => $userData['first_name'] . ' ' . $userData['last_name'],
            'email' => $userData['email']
        ];
        header('Location: ../index.php');
        exit;
    }
    

}
?>