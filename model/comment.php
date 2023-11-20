<?php
    class comment {
        // function loadall_binhluan(){
        //     $db = new connect();
        //     $select="SELECT * FROM comment order by id desc";
        //     return $db->pdo_query($select);
        // }

        // function loadall_binhluan($id_pro){
        //     $db = new connect();
        //     $select="SELECT * FROM comment WHERE 1";
        //     if($id_pro>0) $select.=" AND id_pro='".$id_pro."'";
        //     $select.=" order by id desc";
        
        //     $listbl = $db->pdo_query($select);
        //     return $listbl;
        // }
        function loadall_binhluan($id_pro) {
            $db = new connect();
            $select = "SELECT comment.*, user.name as username FROM comment
                       JOIN user ON comment.id_user = user.id";
            
            if ($id_pro > 0) {
                $select .= " WHERE comment.id_pro = '" . $id_pro . "'";
            }
            
            $select .= " ORDER BY comment.id DESC";
        
            $listbl = $db->pdo_query($select);
            return $listbl;
        }
        

        function insert_binhluan($content, $id_user, $id_pro, $comment_date){
            $db = new connect();
            $select = "INSERT INTO comment(content, id_user, id_pro, comment_date) values( '$content', '$id_user', '$id_pro', '$comment_date')";
            return $db->pdo_execute($select);
        }
    }

    
?>