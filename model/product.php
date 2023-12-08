<?php
class products
{
    function insert_sanpham($tensp, $soluong, $giasp, $mota, $iddm, $targetFiles)
    {
        $db = new connect();
        $select = "INSERT INTO products(name, quantity, price, `describe`, id_category) VALUES ('$tensp','$soluong', '$giasp', '$mota', '$iddm')";

        // Get the ID of the inserted product
        $productID = $db->pdo_execute_return_lastInsertId($select);

        // Insert images
        foreach ($targetFiles as $image) {
            $this->insert_image($productID, $image);
        }
    }

    function insert_image($productID, $image)
    {
        $db = new connect();
        $select = "INSERT INTO images(id_pro, img) VALUES ('$productID', '$image')";
        $db->pdo_execute($select);
    }

    function loadall_sanpham($kyw = "", $iddm = 0, $delete, $start, $limit)
    {
        $db = new connect();
        $select = "SELECT products.*, category.name AS category_name 
                   FROM products 
                   JOIN category ON products.id_category = category.id
                   WHERE 1";

        if ($kyw != "") {
            $select .= " AND products.name LIKE '%" . $kyw . "%'";
        }

        if ($iddm > 0) {
            $select .= " AND products.id_category ='" . $iddm . "'";
        }

        $select .= " AND products.`delete` ='" . $delete . "'";
        $select .= " ORDER BY products.id DESC";
        $select .= " LIMIT $start, $limit";

        return $db->pdo_query($select);
    }

    function loadone_sanpham($id)
    {
        $db = new connect();
        $select = "SELECT products.*, images.img as img, category.name as category_name
                   FROM products 
                   LEFT JOIN images ON products.id = images.id_pro
                   LEFT JOIN category ON products.id_category = category.id
                   WHERE products.id=" . $id;
        $result = $db->pdo_query_one($select);

        // Lấy tất cả các hình ảnh liên quan đến sản phẩm
        $selectImages = "SELECT img FROM images WHERE id_pro=" . $id;
        $images = $db->pdo_query($selectImages);

        // Thêm mảng hình ảnh vào kết quả
        $result['images'] = $images;

        return $result;
    }

    function load_images($id)
    {
        $db = new connect();
        $select = "SELECT * FROM images WHERE id_pro = :id_pro LIMIT 1";
        $params = ['id_pro' => $id];
        return $db->pdo_query_with_params($select, $params);
    }

    function loadall_images($id)
    {
        $db = new connect();
        $select = "SELECT * FROM images WHERE id_pro = :id_pro";
        $params = ['id_pro' => $id];
        return $db->pdo_query_with_params($select, $params);
    }

    public function delete_images($id)
    {
        $db = new connect();

        // Use backticks for reserved keyword `describe`
        $deleteImages = "DELETE FROM images WHERE id_pro=" . $id;

        $db->pdo_execute($deleteImages);
    }



    public function update_sanpham($id, $id_category, $tensp, $soluong, $giasp, $mota, $images, $status)
    {
        $db = new connect();
        // Use backticks for reserved keyword `describe`
        $updateProduct = "UPDATE products SET id_category='" . $id_category . "', name='" . $tensp . "', quantity='" . $soluong . "', price='" . $giasp . "', `describe`='" . $mota . "', status='" . $status . "' WHERE id=" . $id;

        $db->pdo_execute($updateProduct);

        // Delete existing images for the product
        $this->delete_images($id);
        // Insert new images for the product
        foreach ($images as $image) {
            $this->insert_image($id, $image);
        }
    }
    function delete_hidden_sanpham($id)
    {
        $db = new connect();
        $select = "UPDATE products SET `delete` ='1' WHERE id=" . $id;
        return $db->pdo_query($select);
    }
    function restore_sanpham($id)
    {
        $db = new connect();
        $select = "UPDATE products SET `delete` ='0' WHERE id=" . $id;
        return $db->pdo_query($select);
    }

    function delete_sanpham($id)
    {
        $db = new connect();

        // Delete images first
        $this->delete_images($id);

        // Then delete the product
        $select = "DELETE FROM products WHERE id=" . $id;
        return $db->pdo_query($select);
    }

    function loadall_sanpham_home($start, $limit)
    {
        $db = new connect();
        $select = "SELECT products.id, MAX(products.name) as name, MAX(products.price) as price, MAX(images.img) as img, MAX(category.name) as category_name
        FROM products
        LEFT JOIN images ON products.id = images.id_pro
        LEFT JOIN category ON products.id_category = category.id
        GROUP BY products.id
        ORDER BY products.id ASC
        LIMIT $start, $limit;
        ";


        $result = $db->pdo_query($select);

        // Loop through the result and associate images with each product
        foreach ($result as &$product) {
            $selectImages = "SELECT img FROM images WHERE id_pro=" . $product['id'];
            $images = $db->pdo_query($selectImages);
            $product['images'] = $images;
        }

        return $result;
    }
    
    function countAllProducts()
    {
        $db = new connect();
        $select = "SELECT COUNT(*) as total FROM products";
        $result = $db->pdo_query($select);
        return $result[0]['total'];
    }


    function load_sanpham_cungloai($id, $id_category)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE id_category= " . $id_category . " AND id <>" . $id;
        return $db->pdo_query($select);
    }
    function hienthi_sanpham_view()
    {
        $db = new connect();
        $select = "SELECT products.*, images.img as img, category.name as category_name
               FROM products 
               LEFT JOIN images ON products.id = images.id_pro
               LEFT JOIN category ON products.id_category = category.id
               WHERE 1 
               ORDER BY products.view DESC";

        $result = $db->pdo_query($select);

        // Loop through the result and associate images with each product
        foreach ($result as &$product) {
            $selectImages = "SELECT img FROM images WHERE id_pro=" . $product['id'];
            $images = $db->pdo_query($selectImages);
            $product['images'] = $images;
        }

        return $result;
    }

    function loadall_tksanpham($kyw = "", $kytu ="", $iddm = 0, $detete)
    {
    $db = new connect();
    $select = "SELECT products.*, images.img as img, category.name as category_name
               FROM products 
               LEFT JOIN images ON products.id = images.id_pro
               LEFT JOIN category ON products.id_category = category.id
               WHERE products.`delete` ='" . $detete . "'";

    if ($kyw != "") {
        $select .= " AND products.name LIKE '%" . $kyw . "%'";
    }

    if ($iddm > 0) {
        $select .= " AND products.id_category ='" . $iddm . "'";
    }

    if ($kytu === 'kasc') {
        $select .= ' ORDER BY products.name ASC';
    } elseif ($kytu === 'kdesc') {
        $select .= ' ORDER BY products.name DESC';
    } elseif ($kytu === 'pasc') {
        
        $select .= ' ORDER BY products.price ASC';
    } elseif ($kytu === 'pdesc') {
        $select .= ' ORDER BY products.price DESC';
    }else {
        $select .= " ORDER BY products.id DESC";
    }

    return $db->pdo_query($select);
}

    function load_ten_dm($iddm)
    {
        $db = new connect();
        if ($iddm > 0) {
            $sql = "SELECT * FROM category WHERE id=" . $iddm;
            $dm = $db->pdo_query_one($sql);
            extract($dm);
            return $name;
        } else {
            return "";
        }
    }
    function count_sanpham()
    {
        $db = new connect();
        $select = "SELECT COUNT(*) as total_products FROM products";
        $result = $db->pdo_query_one($select);

        if ($result && isset($result['total_products'])) {
            return $result['total_products'];
        }

        return 0; // Trả về 0 nếu có lỗi hoặc không có bản ghi
    }
    function deals_sanpham()
    {
        $db = new connect();
        // lay sp ko bij trung lap
        $select = "SELECT DISTINCT p.*, i.img as img, c.name as category_name
         FROM (
             SELECT *
             FROM products
             ORDER BY price ASC
             LIMIT 4
         ) p
         LEFT JOIN images i ON p.id = i.id_pro
         LEFT JOIN category c ON p.id_category = c.id";

        $result = $db->pdo_query($select);

        // Loop through the result and associate images with each product
        foreach ($result as &$product) {
            $selectImages = "SELECT img FROM images WHERE id_pro=" . $product['id'];
            $images = $db->pdo_query($selectImages);
            $product['images'] = $images;
        }

        return $result;
    }
    public function updateProductQuantity($productId, $newQuantity) {
            $db = new connect();
            $select = "UPDATE products SET quantity = '" . $newQuantity . "' WHERE id = '" . $productId . "'";
            $db->pdo_execute($select);

    }
}
