<?php
class user {
   var $name = null;
   var $Pass = null;
//    var $Name = null;
   var $Email = null;
   var $images = null;

   function loadall_taikhoan(){
      $db = new connect();
      $select="SELECT * FROM user order by id desc";
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
}
?>