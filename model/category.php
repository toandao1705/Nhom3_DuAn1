<?php
class category {
    function loadall_danhmuc(){
        $db = new connect();
        $select="SELECT * FROM category order by id desc";
        return $db->pdo_query($select);
    }
}
?>