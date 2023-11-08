<?php
class banner {
    function loadall_banner(){
        $db = new connect();
        $select="SELECT * FROM banner order by id desc";
        return $db->pdo_query($select);
    }
}
?>