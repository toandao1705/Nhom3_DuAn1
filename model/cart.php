<?php
class cart
{
    function loadall_donhang()
    {
        $db = new connect();
    
        $select = " SELECT bill_detail.id AS bill_id, bill.id_user, bill.status as status, products.name as proname, user.name AS username, bill.order_date as ngaydathang, bill_detail.price as price, bill_detail.quantity as qty
            FROM bill_detail
            LEFT JOIN bill ON bill.id = bill_detail.id_bill
            LEFT JOIN user ON bill.id_user = user.id
            LEFT JOIN products ON products.id = bill_detail.id_pro
            GROUP BY bill_detail.id
            ORDER BY bill_detail.id DESC
        ";
    
        return $db->pdo_query($select);
    }
    

    function insert_bill($iduser, $name, $email, $address, $phone, $payment_methods,$order_date, $total)
    {
        $db = new connect();
        $select = "INSERT INTO bill(id_user, name, email, address, phone, payment_methods, order_date, total) values('$iduser', '$name', '$email', '$address', '$phone', '$payment_methods', '$order_date','$total')";
        return $db->pdo_execute_return_lastInsertId($select);
        echo $select;
    }
    function insert_cart($iduser, $idpro, $img, $name, $price, $quantity, $total)
    {
        $db = new connect();
        $select = "INSERT INTO cart(id_user, id_pro, img, name, price, quantity, total) values('$iduser', '$idpro', '$img', '$name', '$price', '$quantity', '$total')";
        return $db->pdo_execute($select);
        echo $select;
    }

    function tongdonhang()
    {
        $tong = 0;
        foreach ($_SESSION['mycart'] as $cart) {
            $ttien = $cart[3] * $cart[4];
            $tong += $ttien;
        }
        return $tong;
    }
    function loadall_cart($idbill)
    {
        $db = new connect();
        $select = "SELECT * FROM cart WHERE idbill=" . $idbill;
        $bill = $db->pdo_query($select);
        return $bill;
    }
    public function insert_bill_detail($idbill, $idpro, $price, $quantity)
    {
        $db = new connect();
        $sql = "INSERT INTO bill_detail (id_bill, id_pro, price, quantity) VALUES (?, ?, ?, ?)";
        $db->pdo_execute_return_lastInsertId($sql, $idbill, $idpro, $price, $quantity);
    }
    // Trong phương thức getLastInsertedProductId của class cart
    public function getLastInsertedProductId()
    {
        $db = new connect();
        // Thực hiện truy vấn SQL để lấy ID sản phẩm vừa thêm vào
        $query = "SELECT LAST_INSERT_ID() as id";
        $result = $db->pdo_execute_return_lastInsertId($query);

        // Kiểm tra nếu $result là mảng và có khóa 'id'
        if (is_array($result) && isset($result['id'])) {
            // Trích xuất ID từ kết quả truy vấn
            $id = $result['id'];
            return $id;
        } else {
            // Xử lý lỗi hoặc trả về giá trị mặc định
            return 0; // Hoặc giá trị mặc định khác tùy thuộc vào logic của bạn
        }
    }
}
