<?php

namespace Application\Controllers\CrudPoste;

require_once('src/lib/database.php');
require_once('src/model/poste.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Poste\Poste_Model;

class CrudPoste
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
                $poste_model = new Poste_Model();
                $poste_model->connection = new DatabaseConnection();
                $success = $poste_model->createPoste($libelle);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter le poste !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_poste = null;
                $libelle = null;
                if (!empty($input['libelle'])){
                    $id_poste = $input['id_poste'];
                    $libelle = $input['libelle'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $poste_model = new Poste_Model();
                $poste_model->connection = new DatabaseConnection();
                $success = $poste_model->updatePoste($id_poste, $libelle);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_poste = null;
                if (!empty($input['id_poste'])){
                    $id_poste = $input['id_poste'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $poste_model = new Poste_Model();
                $poste_model->connection = new DatabaseConnection();
                $success = $poste_model->deletePoste($id_poste);
            }
        }
        
        $poste_model = new Poste_model();
        $poste_model->connection = new DatabaseConnection();
        $cruds = $poste_model->getPostes();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudposte.php');
        }else{
            header("Location: index.php");
        }
    }
}