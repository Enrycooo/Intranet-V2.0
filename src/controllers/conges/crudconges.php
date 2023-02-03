<?php

namespace Application\Controllers\CrudConges;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');
require_once('src/model/Etat.php');
require_once('src/model/Raison.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_Model;
use Application\Model\Etat\Etat_Model;
use Application\Model\Raison\Raison_Model;

class CrudConges
{
    public function CRUD(int $id_employe, ?array $input){
        
        $id = $id_employe;
        $action = $_REQUEST["action"];
        
        if ($action === 'update') {
            if($input !== null){
                $id_conges = null;
                $id_raison = null;
                $id_etat = null;
                $date_debut = null;
                $date_fin = null;
                $debut_type = null;
                $fin_type = null;
                $duree = null;
                $commentaire = null;
                if (!empty($input['date_debut']) && !empty($input['date_fin']) && !empty($input['debut_type']) && !empty($input['fin_type']) && !empty($input['duree']) && !empty($input['raison']) && !empty($input['etat'])){
                    $id_conges = $input['id_conges'];
                    $id_raison = $input['raison'];
                    $id_etat = $input['etat'];
                    $date_debut = $input['date_debut'];
                    $date_fin = $input['date_fin'];
                    $debut_type = $input['debut_type'];
                    $fin_type = $input['fin_type'];
                    $duree = $input['duree'];
                    $commentaire = $input['commentaire'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $conges_model = new Conges_Model();
                $conges_model->connection = new DatabaseConnection();
                $success = $conges_model->updateConges($id_conges, $id_raison, $id_etat, $date_debut, $date_fin, $debut_type, $fin_type, $duree, $commentaire);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_conges = null;
                if (!empty($input['id_conges'])){
                    $id_conges = $input['id_conges'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $conges_model = new Conges_Model();
                $conges_model->connection = new DatabaseConnection();
                $conges_model->deleteConges($id_conges);
            }
        } else if ($action === 'undelete') {
            if($input !== null){
                $id_conges = null;
                if (!empty($input['id_conges'])){
                    $id_conges = $input['id_conges'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $conges_model = new Conges_Model();
                $conges_model->connection = new DatabaseConnection();
                $conges_model->undeleteConges($id_conges);
            }
        } else if ($action === 'etat'){
            if($input !== null){
                $id_conges = null;
                $id_etat = null;
                $id_raison = null;
                $duree = null;
                $id_emp = null;
                if (!empty($input['id_conges'])){
                    $id_conges = $input['id_conges'];
                    $id_etat = $input['id_etat'];
                    if($id_etat == 3){
                        $duree = $input['duree'];
                        $id_emp = $input['id_employe'];
                    }else if($id_etat == 5 && !empty($input['conges_dispo'])){
                            $duree = $input['duree'];
                            $id_emp = $input['id_employe'];
                    }
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $conges_model = new Conges_Model();
                $conges_model->connection = new DatabaseConnection();
                $conges_model->changeEtat($id_conges, $id_etat);
                
                if($id_etat == 3){
                    if($id_raison == 3){
                    }else{
                        $congesdispo = new Conges_Model();
                        $congesdispo->connection = new DatabaseConnection();
                        $congesdispo->DeleteCongesPris($id_emp, $duree);
                    }
                }else if($id_etat == 5 && !empty($input['conges_dispo'])){
                    if($id_raison == 3){
                    }else{
                        $congesdispo = new Conges_Model();
                        $congesdispo->connection = new DatabaseConnection();
                        $congesdispo->AddCongesPris($id_emp, $duree);
                    }
                }
            }
        }
        
        $crudModel = new Conges_model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getCrudConges();
        
        $raison_model = new Raison_Model();
        $raison_model->connection = new DatabaseConnection();
        $raisons = $raison_model->getRaisons();
        
        $etat_model = new Etat_Model();
        $etat_model->connection = new DatabaseConnection();
        $etats = $etat_model->getEtats();
        
        if($_SESSION['id'] !== ""){
            require('templates/Conges/crudconges.php');
        }else{
            header("Location: index.php");
        }
    }
}