<?php
include("db.php");

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $row = $conn->prepare("SELECT id_raison, id_etat,
                        debut_type, fin_type, duree, commentaire, E.nom AS nom, E.prenom AS prenom
                        FROM conges C INNER JOIN employe E ON C.id_employe=E.id_employe
                        WHERE id_conges = :id");
    $row->bindValue(':id', $id);
    $row->execute();
    $res = $row->fetch(PDO::FETCH_OBJ);
    $data = [
        'id_raison'             => $res->id_raison,
        'id_etat'               => $res->id_etat,
        'debut_type'            => $res->debut_type,
        'fin_type'              => $res->fin_type,
        'duree'                 => $res->duree,
        'commentaire'           => $res->commentaire,
        'nom'                   => $res->nom,
        'prenom'                => $res->prenom
    ];

    echo json_encode($data);
}
