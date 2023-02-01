<?php

namespace Application\Controllers\CrudService;

require_once('src/lib/database.php');
require_once('src/model/service.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Service\Service_model;

class CrudService
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
                $service_model = new Service_model();
                $service_model->connection = new DatabaseConnection();
                $success = $service_model->createService($libelle);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter le service !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_service = null;
                $libelle = null;
                if (!empty($input['libelle'])){
                    $id_service = $input['id_service'];
                    $libelle = $input['libelle'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $service_model = new Service_model();
                $service_model->connection = new DatabaseConnection();
                $success = $service_model->updateService($id_service, $libelle);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_service = null;
                if (!empty($input['id_service'])){
                    $id_service = $input['id_service'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $service_model = new Service_model();
                $service_model->connection = new DatabaseConnection();
                $success = $service_model->deleteService($id_service);
            }
        }
        
        $service_model = new Service_model();
        $service_model->connection = new DatabaseConnection();
        $cruds = $service_model->getServices();
        
        if($_SESSION['id'] !== ""){
            require('templates/Admin/crudservice.php');
        }else{
            header("Location: index.php");
        }
    }
}