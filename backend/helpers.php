<?php
function json_response($data){
    header('Content-Type: application/json; charset=utf-8');
    echo json_encode($data);
    exit;
}
