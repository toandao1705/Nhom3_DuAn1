<?php
    class comment {
        function loadall_binhluan(){
            $db = new connect();
            $select="SELECT * FROM comment order by id desc";
            return $db->pdo_query($select);
        }
    }
?>