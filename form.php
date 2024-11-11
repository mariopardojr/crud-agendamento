<?php
  require_once "service.php";

  if (isset($_POST['submit'])) {
    $customerToEdit = $_SESSION['customerToEdit'];
  
    if (isset($customerToEdit)) {
      $customerToEdit->update($_POST['name'], $_POST['time'], $_POST['date']);
      updateCustomer($connection, $customerToEdit);
      $_SESSION['customerToEdit'] = null;
      return;
    }

    createCustomer($connection, $_POST['name'], $_POST['time'], $_POST['date']);
  }

  if (isset($_POST['search'])) {
    $_SESSION['searchDate'] = $_POST['searchDate'];
    header("Location: index.php");
  }
  
  if (isset($_POST['delete'])) {
    if ($_POST['delete'] === $_SESSION['customerToEdit']->id) {
      $_SESSION['customerToEdit'] = null;
    }

    deleteCustomerById($connection, $_POST['delete']);
  }
  
  if (isset($_POST['edit'])) {
    if ($_SESSION['customerToEdit']) {
      $_SESSION['customerToEdit'] = null;
      header("Location: index.php");
      return;
    }
    
    $_SESSION['customerToEdit'] = getCustomerById($connection, $_POST['edit']);
    header("Location: index.php?event=edit");
  }