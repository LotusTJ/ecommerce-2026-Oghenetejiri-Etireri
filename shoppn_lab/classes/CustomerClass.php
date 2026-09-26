<?php
require_once __DIR__ . '/../core/db_class.php'; 

class CustomerClass extends Database
{
    public function emailExists($email)
    {
        $sql = "SELECT customer_email FROM customer WHERE customer_email = ?";
        $result = $this->fetchOne($sql, [$email]);

        return !empty($result);
    }

    public function insertCustomer($name, $email, $pass, $country, $city, $contact, $image, $role)
    {
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "
            INSERT INTO customer (
                customer_name, 
                customer_email,
                customer_pass,
                customer_country,
                customer_city,
                customer_contact,
                customer_image,
                user_role
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)
        "; 

        return $this->execute(
            $sql,
            [$name, $email, $hashedPassword, $country, $city, $contact, $image, $role]
        );
    }

    public function getAllCustomers()
    {
        $sql = "
            SELECT
                customer_id,
                customer_name,
                customer_email,
                customer_country,
                customer_city,
                customer_contact,
                customer_image,
                user_role
            FROM customer
            ORDER BY customer_id DESC
        ";

        return $this->fetchAll($sql);
    }

    public function getCustomerById($customer_id)
    {
        $sql = "
            SELECT
                customer_id,
                customer_name,
                customer_email,
                customer_country,
                customer_city,
                customer_contact,
                customer_image,
                user_role
            FROM customer
            WHERE customer_id = ?
        ";

        return $this->fetchOne($sql, [$customer_id]);
    }

    public function updateCustomer($customer_id, $name, $email, $pass, $country, $city, $contact, $image, $role)
    {
        $hashedPassword = password_hash($pass, PASSWORD_BCRYPT);

        $sql = "
            UPDATE customer
            SET
                customer_name = ?,
                customer_email = ?,
                customer_pass = ?,
                customer_country = ?,
                customer_city = ?,
                customer_contact = ?,
                customer_image = ?,
                user_role = ?
            WHERE customer_id = ?
        ";

        return $this->execute(
            $sql,
            [$name, $email, $hashedPassword, $country, $city, $contact, $image, $role, $customer_id]
        );
    }

    public function deleteCustomer($customer_id)
    {
        $sql = "
            DELETE FROM customer
            WHERE customer_id = ?
        ";

        return $this->execute($sql, [$customer_id]);
    }

    public function findByEmail($email)
    {
        $sql = "
            SELECT
                customer_id,
                customer_name,
                customer_email,
                customer_pass,
                customer_country,
                customer_city,
                customer_contact,
                customer_image,
                user_role
            FROM customer
            WHERE customer_email = ?
        ";

        return $this->fetchOne($sql, [$email]);
    }
}