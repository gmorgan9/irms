<?php

include(ROOT_PATH . "/app/database/functions.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'expenses';

$errors = array();
$id = '';
$name = '';
$amount = '';
$category = '';
$date = '';
$description = '';

$expenses = selectAll($table);


if (isset($_POST['add-expense'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) {
        unset($_POST['add-expense']);
        $expense_id = create($table, $_POST);
        $_SESSION['message'] = 'Expense created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/expenses/index.php');
        exit(); 
    } else {
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $account = $_POST['account'];
        $date = $_POST['date'];
        $description = $_POST['description'];
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $expense = selectOne($table, ['id' => $id]);
    $id = $expense['id'];
    $name = $expense['name'];
    $amount = $expense['amount'];
    $category = $expense['category'];
    $account = $expense['account'];
    $date = $expense['date'];
    $description = $expense['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Expense deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/expenses/index.php');
    exit();
}


if (isset($_POST['update-expense'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-expense'], $_POST['id']);
        $expense_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Expense updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/expenses/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $amount = $_POST['amount'];
        $category = $_POST['category'];
        $account = $_POST['account'];
        $date = $_POST['date'];
        $description = $_POST['description'];
    }

}
