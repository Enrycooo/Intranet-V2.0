<?php
include('db.php');

header('Content-Type: application/json; charset=utf-8');

$result = $conn->prepare("SELECT COUNT(id_conges) AS id_conges FROM conges WHERE id_etat = 2");
$result->execute();
$res = $result->fetch(PDO::FETCH_OBJ);
$data = [
        'number'             => $res->id_conges
    ];

echo json_encode($data);