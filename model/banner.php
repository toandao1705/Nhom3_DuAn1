<?php
require_once 'pdo.php';
class banner
{
    // load danh sách banner lên
    function loadall_banner($delete, $start, $limit)
    {
        $db = new connect();
        $select = "SELECT * FROM banner WHERE `delete`=" . $delete . " LIMIT $start, $limit";
        return $db->pdo_query($select);
    }
    // thêm banner
    function banner_insert($img, $title, $subtitle)
    {
        $db = new connect();
        $select = "INSERT INTO banner( img, title, subtitle) VALUES (?,?,?)";
        return $db->pdo_execute($select, $img, $title, $subtitle);
    }
    // xóa banner
    function banner_delete($id)
    {
        $db = new connect();
        $select = "DELETE FROM banner WHERE  id=?";
        return $db->pdo_execute($select, $id);
    }
    function loadone_banner($id)
    {
        $db = new connect();
        $select = "SELECT * FROM banner WHERE id=?";
        return $db->pdo_query_one($select, $id);
    }
    function update_banner( $id, $title, $subtitle, $img)
    {
        $db = new connect();
        $select = "UPDATE banner set title='".$title."',subtitle='".$subtitle."',img='".$img."' WHERE id=".$id;
        $db->pdo_execute($select);
    }
    function delete_hidden_banner($id){
        $db = new connect();
        $select="UPDATE banner SET `delete` ='1' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    function restore_banner($id){
        $db = new connect();
        $select="UPDATE banner SET `delete` ='0' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    function delete_banner($id){
        $db = new connect();
        $select="DELETE FROM banner where id=".$id;
        return $db->pdo_query($select);
    }
   
     

    




}
