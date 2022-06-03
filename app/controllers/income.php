<?php

include(ROOT_PATH . "/app/database/functions.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'income';

$errors = array();
$id = '';
$name = '';
$amount = '';
$category = '';
$account = '';
$date = '';
$description = '';

$incomes = selectAll($table);


if (isset($_POST['add-income'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) {
        unset($_POST['add-income']);
        $income_id = create($table, $_POST);
        $_SESSION['message'] = 'Income created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/income/index.php');
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
    $income = selectOne($table, ['id' => $id]);
    $id = $income['id'];
    $name = $income['name'];
    $amount = $income['amount'];
    $category = $income['category'];
    $account = $income['account'];
    $date = $income['date'];
    $description = $income['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Income deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/income/index.php');
    exit();
}


if (isset($_POST['update-income'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-income'], $_POST['id']);
        $income_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Income updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/income/index.php');
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
