<?php
class category {
    function loadall_danhmuc(){
        $db = new connect();
        $select="SELECT * FROM category order by id desc";
        return $db->pdo_query($select);
    }

    function insert_danhmuc($tenloai){
        $db = new connect();
        $select="INSERT INTO category(name) values('$tenloai')";
        $db->pdo_execute($select);
    }

    function loadone_danhmuc($id){
        $db = new connect();
        $select="SELECT * FROM category where id=".$id;
        return $db->pdo_query_one($select);
    }

    function update_danhmuc($id,$tenloai){
        $db = new connect();
        $select="UPDATE category SET name ='".$tenloai."' WHERE id=".$id;
        $db->pdo_execute($select);
    }
    function status_danhmuc($delete){
        $db = new connect();
        $select = "SELECT * FROM category WHERE `delete`=" . $delete;
        return $db->pdo_query($select);
    }
    function delete_hidden($id){
        $db = new connect();
        $select="UPDATE category SET `delete` ='1' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    function restore_danhmuc($id){
        $db = new connect();
        $select="UPDATE category SET `delete` ='0' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    
}
?>