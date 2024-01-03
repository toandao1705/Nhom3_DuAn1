<?php
class connect
{
    function pdo_get_connection()
    {
        $servername = "localhost";
        $username = "root";
        $password = "mysql";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=nhom3duan1", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Kết nối thành công!";
            return $conn;
        } catch (PDOException $e) {
            echo "Kết nối thất bại!: " . $e->getMessage();
        }
    }

    //sql
    // sql,...,id
    //"insert into loai(ten_loai) values(?)","Laptop"
    // "update loai set ten_loai=? where ma_loai=?,"Laptop", "1"
    //"delete form loai where ma_loai=?","1"


    //thêm sửa xóa dữ liệu
  

    function pdo_execute($sql)
{
    $sql_args = array_slice(func_get_args(), 1);
    try {
        $conn = $this->pdo_get_connection();
        $stmt = $conn->prepare($sql);
        $stmt->execute($sql_args);
    } catch (PDOException $e) {
        throw $e;
    } finally {
        unset($conn);
    }
}
 // xóa
    function delete($select)
 {
     $conn = $this->pdo_get_connection();
     $conn->exec($select);
     $conn = null;
 
 }
 
    function pdo_execute_return_lastInsertId($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            return $conn->lastInsertId();
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }


    //truy vấn nhiều dữ liệu
    function pdo_query($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $rows = $stmt->fetchAll();
            return $rows;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }


    //truy vấn 1 dữ liệu
    function pdo_query_one($sql)
    {
        $sql_args = array_slice(func_get_args(), 1);
        try {
            $conn = $this->pdo_get_connection();
            $stmt = $conn->prepare($sql);
            $stmt->execute($sql_args);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            return $row;
        } catch (PDOException $e) {
            throw $e;
        } finally {
            unset($conn);
        }
    }

    //Truy vấn tham số
    function pdo_query_with_params($query, $params) {
        $conn = $this->pdo_get_connection();
        $stmt = $conn->prepare($query);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}
// change the information according to your database
$db_connection = mysqli_connect("localhost","root","mysql","nhom3duan1");
// CHECK DATABASE CONNECTION
if(mysqli_connect_errno()){
    echo "Connection Failed".mysqli_connect_error();
    exit;
}