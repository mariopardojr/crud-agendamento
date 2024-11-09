<?php
require_once "connection.php";
require_once "model.php";
session_start();

function createCustomer($connection, $name, $time, $date) {  
  $query = "INSERT INTO customers (name, time, date) VALUES ('{$name}', {$time}, '{$date}')";
  mysqli_query($connection, $query);
  header("Location: index.php");
  mysqli_close($connection);
}

function getCustomers($connection) {
  $customers = [];
  $query = "SELECT * FROM customers";
  $response = mysqli_query($connection, $query);

  if ($response && mysqli_num_rows($response)) {
    foreach ($response as $customer) {
      $customers[] = new Customer($customer['id'], $customer['name'], $customer['time'], $customer['date']);
    }
  }

  mysqli_close($connection);
  return $customers;
}

function getCustomerById($connection, $id) {
  $customer;
  $query = "SELECT * FROM customers WHERE id = {$id}";
  $response = mysqli_query($connection, $query);

  if ($response && mysqli_num_rows($response)) {
    foreach ($response as $customer) {
      $customer = new Customer($customer['id'], $customer['name'], $customer['time'], $customer['date']);
    }
  }

  return $customer;
}

function updateCustomer($connection, $customer) {
  $query = "UPDATE customers SET name = '{$customer->name}', time = {$customer->time}, date = '{$customer->date}' WHERE id = {$customer->id}";
  $response = mysqli_query($connection, $query);

  if ($response) {
    header("Location: index.php");
  }
  
  mysqli_close($connection);
}

function deleteCustomerById($connection, $id) {
  $query = "DELETE FROM customers WHERE id = {$id}";
  mysqli_query($connection, $query);
  header("Location: index.php");
  mysqli_close($connection);
}