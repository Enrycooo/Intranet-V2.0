<?php

namespace Application\Controllers\CrudEntite;

require_once('src/lib/database.php');
require_once('src/model/Entite.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Entite\Entite_Model;

class CrudEntite
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
                $entite_model = new Entite_Model();
                $entite_model->connection = new DatabaseConnection();
                $success = $entite_model->createEntite($libelle);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter l\'état !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_entite = null;
                $libelle = null;
                if (!empty($input['libelle'])){
                    $id_entite = $input['id_entite'];
                    $libelle = $input['libelle'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $entite_model = new Entite_Model();
                $entite_model->connection = new DatabaseConnection();
                $success = $entite_model->updateEntite($id_entite, $libelle);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_entite = null;
                if (!empty($input['id_entite'])){
                    $id_entite = $input['id_entite'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $entite_model = new Entite_Model();
                $entite_model->connection = new DatabaseConnection();
                $success = $entite_model->deleteEntite($id_entite);
            }
        }
        
        $entite_model = new Entite_Model();
        $entite_model->connection = new DatabaseConnection();
        $cruds = $entite_model->getEntites();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudentite.php');
        }else{
            header("Location: index.php");
        }
    }
}