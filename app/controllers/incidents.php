<?php

include(ROOT_PATH . "/app/database/db.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
include(ROOT_PATH . "/app/helpers/validateIncident.php");

$table = 'incidents';

$errors = array();
$id = '';
$inc_num = '';
$priority = '';
$description = '';
$assign_group = '';
$kb_article = '';
$date = '';
$time = '';

$incidents = selectAll($table);


if (isset($_POST['add-incident'])) {
    //adminOnly();
    $errors = validateIncident($_POST);

    if (count($errors) === 0) {
        unset($_POST['add-incident']);
        $incident_id = create($table, $_POST);
        $_SESSION['message'] = 'Incident created successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/incidents/index.php');
        exit(); 
    } else {
        $inc_num = $_POST['inc_num'];
        $priority = $_POST['priority'];
        $description = $_POST['description'];
        $assign_group = $_POST['assign_group'];
        $kb_article = $_POST['kb_article'];
        $date = $_POST['date'];
        $time = $_POST['time'];
    }
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $incidents = selectOne($table, ['id' => $id]);
    $id = $incidents['id'];
    $inc_num = $incidents['inc_num'];
    $priority = $incidents['priority'];
    $description = $incidents['description'];
    $assign_group = $incidents['assign_group'];
    $kb_article = $incidents['kb_article'];
    $date = $incidents['date'];
    $time = $incidents['time'];
}

if (isset($_GET['del_id'])) {
    //adminOnly();
    $id = $_GET['del_id'];
    $count = delete($table, $id);
    $_SESSION['message'] = 'Incident deleted successfully';
    $_SESSION['type'] = 'success';
    header('location: ' . BASE_URL . '/admin/incidents/index.php');
    exit();
}


if (isset($_POST['update-incident'])) {
    //adminOnly();
    $errors = validateIncident($_POST);

    if (count($errors) === 0) { 
        $id = $_POST['id'];
        unset($_POST['update-incident'], $_POST['id']);
        $incident_id = update($table, $id, $_POST);
        $_SESSION['message'] = 'Incident updated successfully';
        $_SESSION['type'] = 'success';
        header('location: ' . BASE_URL . '/admin/incidents/index.php');
        exit();
    } else {
        $id = $_POST['id'];
        $id = $incidents['id'];
        $inc_num = $incidents['inc_num'];
        $priority = $incidents['priority'];
        $description = $incidents['description'];
        $assign_group = $incidents['assign_group'];
        $kb_article = $incidents['kb_article'];
        $date = $incidents['date'];
        $time = $incidents['time'];
    }

}
