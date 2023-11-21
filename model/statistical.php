<?php
 class statistical {
    function loadall_thongke(){
        $db = new connect();
        $select = "SELECT category.id AS madm, category.name AS tendm, count(products.id) AS countsp, min(products.price) AS minprice, max(products.price) AS maxprice, avg(products.price) AS avgprice"; 
        $select .= " FROM products LEFT JOIN category ON category.id = products.id_category";
        $select .= " GROUP BY category.id ORDER BY category.id DESC";
        return $db->pdo_query($select);
    }
    
    function loadall_thongkebl(){
        $db = new connect();
        $select = "SELECT products.name AS tensp, user.name AS tenkh, count(comment.id) AS countcm, MAX(comment.comment_date) AS ngaybl_gannhat, MIN(comment.comment_date) AS ngaybl_launhat"; 
        $select .= " FROM products LEFT JOIN category ON category.id = products.id_category";
        $select .= " INNER JOIN comment ON comment.id_pro = products.id";
        $select .= " INNER JOIN user ON user.id = comment.id_user";
        $select .= " GROUP BY products.id, user.id";
        return $db->pdo_query($select);
    }
}
?>