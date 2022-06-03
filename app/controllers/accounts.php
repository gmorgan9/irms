<?php

include(ROOT_PATH . "/app/database/functions.php");
include(ROOT_PATH . "/app/helpers/middleware.php");

$table = 'accounts';

$errors = array();
$id = '';
$name = '';
$description = '';

$accounts = selectAll($table);


if (isset($_POST['add-account'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) {
        unset($_POST['add-account']);
        $account_id = create($table, $_POST);
        $_SESSION['message'] = 'Account created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/accounts/index.php');
        exit(); 
    } else {
        $name = $_POST['name'];
        $description = $_POST['description'];
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $account = selectOne($table, ['id' => $id]);
    $id = $account['id'];
    $name = $account['name'];
    $description = $account['description'];
}

if (isset($_GET['del_id'])) {
    adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Account deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/accounts/index.php');
    exit();
}


if (isset($_POST['update-account'])) {
    adminOnly();
    $errors;

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-account'], $_POST['id']);
        $account_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Account updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/accounts/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $description = $_POST['description'];
    }

}
