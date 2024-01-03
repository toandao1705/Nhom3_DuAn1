<?php
class user {
   var $name = null;
   var $Pass = null;
   var $Email = null;
   var $images = null;

   function loadall_taikhoan($delete, $start, $limit){
      $db = new connect();
      $select = "SELECT * FROM user WHERE `delete` = '$delete' ORDER BY id DESC LIMIT $start, $limit";
      return $db->pdo_query($select);
  }

   function getUser()
   {
      $db = new connect();
      $select = "SELECT * FROM user";
      return $db->pdo_query($select);
   }

   function getUserEmail($email)
   {
      $db = new connect();
      $select = "SELECT * FROM user WHERE email ='$email'";
      $result = $db->pdo_query($select);
      if ($result) {
         return $result;
      } else {
         echo '<h4 style="color:red;"> Email does not exist</h4> </br>';
      }
   }
   
   public function checkUser($name,$pass) 
   { 
       $db = new connect();               
       $select="SELECT * FROM user where name='$name' and pass='$pass' and role = '1'"; 
       $result = $db->pdo_query_one($select);
       if($result!=null) 
           return true; 
       else 
           return false; 
   }

   function checkUsers($name, $pass) 
   { 
       $db = new connect();
   
       // Mã hóa mật khẩu trước khi so sánh với cơ sở dữ liệu
       $passwordEncryption = md5($pass);
   
       $select = "SELECT * FROM user WHERE name = '$name' AND pass = '$passwordEncryption' AND role = '1'";

       return $db->pdo_query_one($select);
   }
   function checkUsersClient($name, $pass) 
   { 
       $db = new connect();
   
       // Mã hóa mật khẩu trước khi so sánh với cơ sở dữ liệu
       $passwordEncryption = md5($pass);
   
       $select = "SELECT * FROM user WHERE name = '$name' AND pass = '$passwordEncryption'";

       return $db->pdo_query_one($select);
   }

   function forgetPass($pass,$email){
      $db = new connect();
      $passwordEncryption = md5($pass);
      $sql ="UPDATE user SET pass ='$passwordEncryption' WHERE email ='$email'";
      $result = $db->pdo_execute($sql);
   }

   function checkEmail($email) 
{ 
    $db = new connect();
    $select = "SELECT * FROM user WHERE email = '".$email."'";
    return $db->pdo_query_one($select);
}
   
   function insert_taikhoan($name, $email, $pass, $address, $phone){
      $db = new connect();
      $passwordEncryption = md5($pass);
      $sql = "INSERT INTO user(name, email, pass, address, phone) values('$name', '$email', '$passwordEncryption', '$address', '$phone')";
      $db->pdo_execute($sql);
  }

   public function userid($name,$pass) 
    { 
        $db = new connect();               
        $select="select id from user where name='$name' and pass='$pass' and role = '1'"; 
        $result = $db->pdo_query_one($select);
        return $result;
    }

   public function getInfoById($username)
   {
      $db = new connect();
      $select = "select * from users where Username='$username'";
      $result = $db->pdo_query($select);
    //   $quest = $result->fetch();
      return $result;
   }

   function insertUser($tmpUsername, $tmpPassword, $tmpName, $tmpEmail, $tmpPermisions, $tmpPhone)
   {
      $db = new connect();
      $query = "INSERT INTO users(UserID,Username,Password,FullName,Email ,Permissions, Avatar,Address,Phone) VALUES (NULL,'$tmpUsername','$tmpPassword','$tmpName','$tmpEmail','$tmpPermisions','','',$tmpPhone)";
      $db->pdo_execute($query);
   }

   function updateUser($tmpUsername, $tmpPassword, $tmpName, $tmpEmail)
   {
      $db = new connect();
      $query = "update users set Password='$tmpPassword',Username='$tmpName',Email='$tmpEmail' where Username='$tmpUsername'";
      $db->pdo_execute($query);
   }

   function deleteUser($id)
   {
      $db = new connect();
      $query = "delete from users where UserName = '$id'";
      $db->pdo_execute($query);
   }
   function delete_hidden_taikhoan($id){
      $db = new connect();
      $select="UPDATE user SET `delete` ='1' WHERE id=".$id;
      return $db->pdo_query($select);
  }
  function restore_taikhoan($id){
        $db = new connect();
        $select="UPDATE user SET `delete` ='0' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    function delete_comments_by_user_id($user_id) {
      $db = new connect();
      $select = "DELETE FROM comment WHERE id_user=" . $user_id;
      $db->pdo_query($select);
   }
    function delete_taikhoan($id) {
      $this->delete_comments_by_user_id($id); // Xóa bình luận trước
      $db = new connect();
      $select = "DELETE FROM user WHERE id=" . $id;
      return $db->pdo_query($select);
  }
  function loadone_taikhoan($id){
   $db = new connect();
   $select="SELECT * FROM user WHERE id=".$id;
   $sp=$db->pdo_query_one($select);
   return $sp;
}
function update_taikhoan($id, $email, $address, $phone, $role){
   $db = new connect();
   // $passwordEncryption = md5($pass);
   $select = "UPDATE user SET email='".$email."', address='".$address."', phone='".$phone."', role=".$role." WHERE id=".$id;
   $db->pdo_execute($select);
}
function update_taikhoanUser($id, $email, $address, $phone, $role) {
   $db = new connect();
   $select = "UPDATE user SET email='".$email."', address='".$address."', phone='".$phone."', role=".$role." WHERE id=".$id;
   var_dump($select); // In câu lệnh SQL để kiểm tra xem có vấn đề gì không
   $db->pdo_execute($select);
}
public function getUserInfoById($id) {
   $db = new connect();
   $select = "SELECT * FROM user WHERE id = $id";
   return $db->pdo_query_one($select);
}
public function checkUserUpdateOne($email, $id) 
{ 
    $db = new connect();               
    $select = "SELECT * FROM user WHERE email = '$email' AND id != $id";
    $result = $db->pdo_query_one($select);

    // Kiểm tra xem có dữ liệu trả về hay không
    if($result != null) {
        return true; // Email đã tồn tại cho một người dùng khác
    } else {
        return false; // Email không tồn tại hoặc chỉ tồn tại cho chính người dùng này
    }
}



function checkUserOne($name, $pass){
   $db = new connect();
   $passwordEncryption = md5($pass);
   $select = "SELECT * FROM user WHERE name='" . $name . "' AND pass='" . $passwordEncryption . "'";
   $userData = $db->pdo_query_one($select);
   return $userData;
    
}
function count_taikhoan() {
   $db = new connect();
   $select = "SELECT COUNT(*) as total_user FROM user";
   $result = $db->pdo_query_one($select);

   if ($result && isset($result['total_user'])) {
       return $result['total_user'];
   }

   return 0; // Trả về 0 nếu có lỗi hoặc không có bản ghi
}
public function checkUserUpdate($email, $name) 
{ 
    $db = new connect();               
    $select = "SELECT * FROM user WHERE email = '$email' OR name = '$name'";
    $result = $db->pdo_query_one($select);

    // Kiểm tra xem có dữ liệu trả về hay không
    if($result != null) {
        return true; // Email đã tồn tại
    } else {
        return false; // Email không tồn tại
    }
}

}
?>