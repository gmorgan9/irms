<?php

include(ROOT_PATH . "/app/database/functions.php");
//include(ROOT_PATH . "/app/helpers/middleware.php");
include("app/helpers/validateIncident.php");

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

$incident = selectAll($table);


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
    $incident = selectOne($table, ['id' => $id]);
    $id = $incident['id'];
    $inc_num = $incident['inc_num'];
    $priority = $incident['priority'];
    $description = $incident['description'];
    $assign_group = $incident['assign_group'];
    $kb_article = $incident['kb_article'];
    $date = $incident['date'];
    $time = $incident['time'];
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
    adminOnly();
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
        $id = $incident['id'];
        $inc_num = $incident['inc_num'];
        $priority = $incident['priority'];
        $description = $incident['description'];
        $assign_group = $incident['assign_group'];
        $kb_article = $incident['kb_article'];
        $date = $incident['date'];
        $time = $incident['time'];
    }

}
