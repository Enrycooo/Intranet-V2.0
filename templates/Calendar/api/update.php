<?php
include("db.php");

if (isset($_POST['id'])) {

    //collect data
    $error      = null;
    $id         = $_POST['id'];
    $start      = $_POST['start'];
    $end        = $_POST['end'];
    $debut_type = $_POST['debut_type'];
    $fin_type   = $_POST['fin_type'];
    $raison     = $_POST['id_raison'];
    $etat       = $_POST['id_etat'];
    $commentaire= $_POST['commentaire'];
    $duree      = $_POST['duree'];

    //validation
    if ($start == '') {
        $error['start'] = 'Start date is required';
    }

    if ($end == '') {
        $error['end'] = 'End date is required';
    }
    
    if ($debut_type == '') {
        $error['end'] = 'Type de debut de conges is required';
    }
    
    if ($fin_type == '') {
        $error['end'] = 'Type de fin de conges is required';
    }
    
    if ($raison == '') {
        $error['end'] = 'Raison is required';
    }
    
    if ($etat == '') {
        $error['end'] = 'Etat is required';
    }
    if ($commentaire == '') {
        $error['end'] = 'Commentaire is required';
    }
    
    if ($duree == '') {
        $error['end'] = 'Duree is required';
    }
    

    //if there are no errors, carry on
    if (! isset($error)) {

        //reformat date
        $start = date('Y-m-d H:i', strtotime($start));
        $end = date('Y-m-d H:i', strtotime($end));
        
        $data['success'] = true;
        $data['message'] = 'Success!';

        //update database
        $conn->prepare("UPDATE conges
                    SET id_raison = :id_raison, id_etat = :id_etat, date_debut = :date_debut,
                    date_fin = :date_fin, debut_type = :debut_type, fin_type = :fin_type,
                    duree = :duree, commentaire = :commentaire
                    WHERE id_conges = :id");
        $row->bindValue(':id', $id);
        $row->bindValue(':id_raison', $raison);
        $row->bindValue(':id_etat', $etat);
        $row->bindValue(':date_debut', $start);
        $row->bindValue(':date_fin', $end);
        $row->bindValue(':debut_type', $debut_type);
        $row->bindValue(':fin_type', $fin_type);
        $row->bindValue(':duree', $duree);
        $row->bindValue(':commentaire', $commentaire);
        
        $row->execute();
      
    } else {

        $data['success'] = false;
        $data['errors'] = $error;
    }

    echo json_encode($data);
}