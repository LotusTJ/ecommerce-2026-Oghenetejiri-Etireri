<?php

require_once "../classes/CustomerClass.php";

class CustomerController
{
    private $customer;

    public function __construct()
    {
        $this->customer = new CustomerClass();
    }

    public function register($data)
    {
        if ($this->customer->emailExists($data['email'])) {
            return ['success' => false, 'error' => 'Email already registered'];
        }

        $result = $this->customer->insertCustomer(
            $data['name'],
            $data['email'],
            $data['pass'],
            $data['country'],
            $data['city'],
            $data['contact'],
            $data['image'],
            $data['role']
        );

        if ($result) {
            return ['success' => true];
        }

        return ['success' => false, 'error' => 'Failed to register customer'];
    }

    public function insert($name, $email, $pass, $country, $city, $contact, $image, $role)
    {
        return $this->customer->insertCustomer($name, $email, $pass, $country, $city, $contact, $image, $role);
    }

    //get full list of customers
    public function selectAll()
    {
        return $this->customer->getAllCustomers();
    }

    public function findByEmail($email)
    {
        return $this->customer->emailExists($email);
    }

    public function update($customer_id, $name, $email, $pass, $country, $city, $contact, $image, $role)
    {
        return $this->customer->updateCustomer($customer_id, $name, $email, $pass, $country, $city, $contact, $image, $role);
    }

    public function delete($customer_id)
    {
        return $this->customer->deleteCustomer($customer_id);
    }
}