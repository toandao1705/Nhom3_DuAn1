<?php
class category {
    function loadall_danhmuc() {
        $db = new connect();
        $select = "SELECT category.*, COUNT(products.id) AS product_count
                   FROM category 
                   LEFT JOIN products ON category.id = products.id_category
                   GROUP BY category.id
                   ORDER BY category.id DESC";
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
    function status_danhmuc($delete, $start, $limit){
        $db = new connect();
        $select = "SELECT * FROM category WHERE `delete`=" . $delete . " LIMIT $start, $limit";
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
    function delete_danhmuc($id) {
        $db = new connect();
        
        try {
            // Cố gắng xóa danh mục
            $select = "DELETE FROM category WHERE id=" . $id;
            $db->pdo_query($select);
            
            // Nếu thành công, trả về true
            return true;
        } catch (PDOException $e) {
            // Nếu xóa thất bại do ràng buộc khóa ngoại, bắt lỗi
            if ($e->errorInfo[1] == 1451) {
                // Lỗi vi phạm ràng buộc khóa ngoại (mã lỗi 1451)
                return false;
            } else {
                // Lỗi cơ sở dữ liệu khác
                throw $e;
            }
        }
    }
    
}
?>

