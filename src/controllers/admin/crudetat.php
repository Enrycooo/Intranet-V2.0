<?php

namespace Application\Controllers\CrudEtat;

require_once('src/lib/database.php');
require_once('src/model/etat.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Etat\Etat_Model;

class CrudEtat
{
    
    public function CRUD(int $id_employe, ?array $input){
        
        $id = $id_employe;
        $action = $_REQUEST["action"];
        
        if ($action === 'create') {
            if($input !== null){
                $libelle = null;
                if (!empty($input['libelle'])){
                    $libelle = $input['libelle'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $etat_model = new Etat_Model();
                $etat_model->connection = new DatabaseConnection();
                $success = $etat_model->createEtat($libelle);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter l\'état !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_etat = null;
                $libelle = null;
                if (!empty($input['libelle'])){
                    $id_etat = $input['id_etat'];
                    $libelle = $input['libelle'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $etat_model = new Etat_Model();
                $etat_model->connection = new DatabaseConnection();
                $success = $etat_model->updateEtat($id_etat, $libelle);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_etat = null;
                if (!empty($input['id_etat'])){
                    $id_etat = $input['id_etat'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $etat_model = new Etat_Model();
                $etat_model->connection = new DatabaseConnection();
                $success = $etat_model->deleteEtat($id_etat);
            }
        }
        
        $etat_model = new Etat_Model();
        $etat_model->connection = new DatabaseConnection();
        $cruds = $etat_model->getEtats();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudetat.php');
        }else{
            header("Location: index.php");
        }
    }
}