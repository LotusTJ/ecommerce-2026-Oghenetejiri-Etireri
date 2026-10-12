<?php
require_once __DIR__ . '/../core/db_class.php';

class ProductClass extends Database 
{
    public function addBrand($name)
    {
        $sql = "INSERT INTO brands (brand_name) VALUES (?)";
        return $this->execute($sql, [$name]);
    }

    public function getAllBrands()
    {
        $sql = "SELECT * FROM brands ORDER BY brand_id ASC";
        return $this->fetchAll($sql);
    }

    public function getBrandById($brand_id)
    {
        $sql = "SELECT * FROM brands WHERE brand_id = ?";
        return $this->fetchOne($sql, [$brand_id]);
    }

    public function updateBrand($brand_id, $name)
    {
        $sql = "UPDATE brands SET brand_name = ? WHERE brand_id = ?";
        return $this->execute($sql, [$name, $brand_id]);
    }

    public function addCategory($name)
    {
        $sql = "INSERT INTO categories (cat_name) VALUES (?)";
        return $this->execute($sql, [$name]);
    }

    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories ORDER BY cat_id ASC";
        return $this->fetchAll($sql);
    }

    public function getCategoryById($cat_id)
    {
        $sql = "SELECT * FROM categories WHERE cat_id = ?";
        return $this->fetchOne($sql, [$cat_id]);
    }

    public function updateCategory($cat_id, $name)
    {
        $sql = "UPDATE categories SET cat_name = ? WHERE cat_id = ?";
        return $this->execute($sql, [$name, $cat_id]);
    }

    public function addProduct($cat, $brand, $title, $price, $desc, $image, $keywords) 
    {
        $sql = "
            INSERT INTO products (
                product_cat, 
                product_brand, 
                product_title, 
                product_price, 
                product_desc, 
                product_image, 
                product_keywords
            ) VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        return $this->execute(
            $sql,
            [$cat, $brand, $title, $price, $desc, $image, $keywords]
        );
    }

    public function updateProduct($id, $cat, $brand, $title, $Price, $desc, $image, $keywords) 
    {
        $sql = "
            UPDATE products 
            SET product_cat = ?, 
                product_brand = ?, 
                product_title = ?, 
                product_price = ?, 
                product_desc = ?, 
                product_image = ?, 
                product_keywords = ? 
            WHERE product_id = ?
        ";

        return $this->execute(
            $sql,
            [$cat, $brand, $title, $Price, $desc, $image, $keywords, $id]);
    }

    public function getProductById($id)
    {
        $sql = "SELECT products.*, categories.cat_name, brands.brand_name
                FROM products
                JOIN categories ON products.product_cat = categories.cat_id
                JOIN brands ON products.product_brand = brands.brand_id
                WHERE products.product_id = ?";
        return $this->fetchOne($sql, [$id]);
    }

    public function getProductsByCategory($cat_id)
    {
        $sql = "SELECT * FROM products WHERE product_cat = ?";
        return $this->fetchAll($sql, [$cat_id]);
    }

    public function getProductsByBrand($brand_id)
    {
        $sql = "SELECT * FROM products WHERE product_brand = ?";
        return $this->fetchAll($sql, [$brand_id]);
    }

    public function searchProducts($query)
    {
        $sql = "SELECT * FROM products 
                WHERE product_title LIKE ?              
                OR product_keywords LIKE ?";
        $likeQuery = '%' . $query . '%';
        return $this->fetchAll($sql, [$likeQuery, $likeQuery]);
    }

    public function getFeaturedProducts($limit = 6)
    {
        $sql = "SELECT * FROM products ORDER BY RAND() LIMIT ?"; 
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(1, $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}