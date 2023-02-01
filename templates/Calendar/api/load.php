<?php
include('db.php');
//J'ai du refaire une connexion à la BDD et des requêtes spéciales pour le calendrier
//car j'avais des problèmes de lien entre les fichiers et de variable non défini.
$result = $conn->prepare("SELECT id_conges, date_debut, date_fin, EM.nom AS nom, EM.prenom AS prenom,
                        E.color AS color
                        FROM conges C INNER JOIN employe EM ON C.id_employe = EM.id_employe
                        INNER JOIN etat E ON C.id_etat = E.id_etat");
$result->execute();
$res = $result->fetchALL(PDO::FETCH_OBJ);

$data = [];
foreach($res as $row) {
    $data[] = [
        'id'              => $row->id_conges,
        'title'           => $row->nom." ".$row->prenom,
        'start'           => $row->date_debut,
        'end'             => $row->date_fin,
        'color'           => $row->color
    ];
}

echo json_encode($data); //json_encode permet d'encoder l'array $data en json pour que fullcalendar puisse
//l'utiliser. Et le 'echo' est obligatoire
