<?php
// Xóa biến session 'admin'
unset($_SESSION['admin']);
// Chuyển hướng hoặc thực hiện các hành động khác sau khi xóa session
// Ví dụ: chuyển hướng đến trang khác
header('location: ./index.php');
?>