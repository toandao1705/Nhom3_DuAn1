<?php
class user {
   var $name = null;
   var $Pass = null;
//    var $Name = null;
   var $Email = null;
   var $images = null;

   function loadall_taikhoan($delete){
      $db = new connect();
      $select="SELECT * FROM user WHERE `delete`=" . $delete . " order by id desc";
      return $db->pdo_query($select);
  }

   function getUser()
   {
      $db = new connect();
      $select = "select * from user";
      return $db->pdo_query($select);
   }
   public function checkUser($name,$pass) 
   { 
       $db = new connect();               
       $select="select * from user where name='$name' and pass='$pass'"; 
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
   
       $select = "SELECT * FROM user WHERE name = '$name' AND pass = '$passwordEncryption'";

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
        $select="select id from user where name='$name' and pass='$pass'"; 
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
   function delete_taikhoan($id){
      $db = new connect();
      $select="DELETE FROM user where id=".$id;
      return $db->pdo_query($select);
  }
}
?>