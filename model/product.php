<?php
class products
{
    function insert_sanpham($tensp, $giasp, $mota, $iddm, $images)
    {
        $db = new connect();
        $select = "INSERT INTO products(name, price, `describe`, id_category) VALUES ('$tensp', '$giasp', '$mota', '$iddm')";

        $db->pdo_execute($select);

        // Get the ID of the inserted product
        $productID = $db->pdo_execute_return_lastInsertId($select);

        // Insert images
        foreach ($images as $image) {
            $this->insert_image($productID, $image);
        }
    }

    function insert_image($productID, $image)
    {
        $db = new connect();
        $select = "INSERT INTO images(id_pro, img) VALUES ('$productID', '$image')";
        $db->pdo_execute($select);
    }

    function loadall_sanpham($kyw = "", $iddm = 0, $detete)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE 1";
        if ($kyw != "") {
            $select .= " and name like '%" . $kyw . "%'";
        }
        if ($iddm > 0) {
            $select .= " and id_category ='" . $iddm . "'";
        }
        $select .= " and `delete` ='" . $detete . "'";
        $select .= " ORDER BY id DESC";
        return $db->pdo_query($select);
    }
    function loadone_sanpham($id)
    {
        $db = new connect();
        $select = "SELECT * FROM products WHERE id=" . $id;
        return $db->pdo_query_one($select);
    }
    function load_images($id)
    {
        $db = new connect();
        $select = "SELECT * FROM images WHERE id_pro = :id_pro LIMIT 1";
        $params = ['id_pro' => $id];
        return $db->pdo_query_with_params($select, $params);
    }
    // In products class
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



    public function update_sanpham($id, $id_category, $tensp, $giasp, $mota, $images)
    {
        $db = new connect();
        // Use backticks for reserved keyword `describe`
        $updateProduct = "UPDATE products SET id_category='" . $id_category . "', name='" . $tensp . "', price='" . $giasp . "', `describe`='" . $mota . "' WHERE id=" . $id;

        $db->pdo_execute($updateProduct);

        // Delete existing images for the product
        $this->delete_images($id);
        // Insert new images for the product
        foreach ($images as $image) {
            $this->insert_image($id, $image);
        }
    }
    function delete_hidden_sanpham($id){
        $db = new connect();
        $select="UPDATE products SET `delete` ='1' WHERE id=".$id;
        return $db->pdo_query($select);
    }
    function restore_sanpham($id){
        $db = new connect();
        $select="UPDATE products SET `delete` ='0' WHERE id=".$id;
        return $db->pdo_query($select);
    }

    function delete_sanpham($id) {
        $db = new connect();

        // Delete images first
        $this->delete_images($id);

        // Then delete the product
        $select = "DELETE FROM products WHERE id=" . $id;
        return $db->pdo_query($select);
    }

    function loadall_sanpham_home() {
        $db = new connect();
        $select = "SELECT products.*, images.img as img, category.name as category_name
                   FROM products 
                   LEFT JOIN images ON products.id = images.id_pro
                   LEFT JOIN category ON products.id_category = category.id
                   WHERE 1 
                   ORDER BY products.id DESC limit 0,10";
        return $db->pdo_query($select);
    }
    
    

}
