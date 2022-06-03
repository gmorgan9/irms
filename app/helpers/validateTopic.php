<?php

function validateIncident($incident)
{
    $errors = array();

    if (empty($incident['inc_num'])) {
        array_push($errors, 'Name is required');
    }

    $existingIncident = selectOne('incidents', ['inc_num' => $post['inc_num']]);
    if ($existingIncident) {
        if (isset($post['update-incident']) && $existingIncident['id'] != $incident['id']) {
            array_push($errors, 'Name already exists');
        }

        if (isset($post['add-incident'])) {
            array_push($errors, 'Name already exists');
        }
    }

    return $errors;
}
