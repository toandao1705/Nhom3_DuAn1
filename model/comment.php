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
        function loadall_binhluan($id_pro, $delete, $start, $limit) {
            $db = new connect();
            $select = "SELECT comment.*, user.name as username FROM comment
                       JOIN user ON comment.id_user = user.id";
            
            if ($id_pro > 0) {
                $select .= " WHERE comment.id_pro = '" . $id_pro . "'";
            }
            $select .= " AND comment.delete=" . $delete;

            $select .= " ORDER BY comment.id LIMIT $start, $limit";
        
            $listbl = $db->pdo_query($select);
            return $listbl;
        }
        

        function insert_binhluan($content, $id_user, $id_pro, $comment_date){
            $db = new connect();
            $select = "INSERT INTO comment(content, id_user, id_pro, comment_date) values( '$content', '$id_user', '$id_pro', '$comment_date')";
            return $db->pdo_execute($select);
        }
        function delete_hidden_binhluan($id){
            $db = new connect();
            $select="UPDATE comment SET `delete` ='1' WHERE id=".$id;
            return $db->pdo_query($select);
        }
        function restore_binhluan($id){
            $db = new connect();
            $select="UPDATE comment SET `delete` ='0' WHERE id=".$id;
            return $db->pdo_query($select);
        }
        function delete_binhluan($id){
            $db = new connect();
            $select="DELETE FROM comment where id=".$id;
            return $db->pdo_query($select);
        }
        function count_binhluan() {
            $db = new connect();
            $select = "SELECT COUNT(*) as total_comment FROM comment";
            $result = $db->pdo_query_one($select);
        
            if ($result && isset($result['total_comment'])) {
                return $result['total_comment'];
            }
        
            return 0; // Trả về 0 nếu có lỗi hoặc không có bản ghi
        }
    }

    
?>