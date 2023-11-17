<?php
 class cart {
        function loadall_donhang(){
            $db = new connect();
            $select="SELECT * FROM bill order by id desc";
            return $db->pdo_query($select);
        }
    }
?>