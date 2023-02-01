<?php

namespace Application\Controllers\CrudUser;

require_once('src/lib/database.php');
require_once('src/model/User.php');
require_once('src/model/Service.php');
require_once('src/model/Poste.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;
use Application\Model\Service\Service_Model;
use Application\Model\Poste\Poste_Model;

class CrudUser
{
    
    public function CRUD(int $id_employe, ?array $input){
        
        $id = $id_employe;
        $action = $_REQUEST["action"];
        
        if ($action === 'create') {
            if($input !== null){
                $nom = null;
                $prenom = null;
                $username = null;
                $email = null;
                $password = null;
                $poste = null;
                $service = null;
                $telephone = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['username']) && !empty($input['email']) && !empty($input['telephone']) && !empty($input['password']) && !empty($input['poste']) && !empty($input['service'])){
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $username = $input['username'];
                    $email = $input['email'];
                    $telephone = $input['telephone'];
                    $password = crypt($input['password'],'$6$rounds=5000$gA6Fkf92AFMpn3cGK$');
                    $poste = $input['poste'];
                    $service = $input['service'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $success = $user_model->createUser($nom, $prenom, $username, $email, $telephone, $password, $poste, $service);
                if (!$success) {
                    throw new \Exception('Impossible d\'ajouter l\'Utilisateur !');
                } else {
                }
            }
        } else if ($action === 'update') {
            if($input !== null){
                $id_employe = null;
                $nom = null;
                $prenom = null;
                $username = null;
                $email = null;
                $telephone = null;
                $password = null;
                $poste = null;
                $service = null;
                if (!empty($input['nom']) && !empty($input['prenom']) && !empty($input['username']) && !empty($input['email']) && !empty($input['telephone']) && !empty($input['password']) && !empty($input['poste']) && !empty($input['service'])){
                    $id_employe = $input['id_employe'];
                    $nom = $input['nom'];
                    $prenom = $input['prenom'];
                    $username = $input['username'];
                    $email = $input['email'];
                    $telephone = $input['telephone'];
                    $password = crypt($input['password'],'$6$rounds=5000$gA6Fkf92AFMpn3cGK$');
                    $poste = $input['poste'];
                    $service = $input['service'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $user_model->updateUser($id_employe, $nom, $prenom, $username, $email, $telephone, $password, $poste, $service);
            }
        } else if ($action === 'delete') {
            if($input !== null){
                $id_employe = null;
                if (!empty($input['id_employe'])){
                    $id_employe = $input['id_employe'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $user_model->deleteUser($id_employe);
            }
        } else if ($action === 'conges') {
            if($input !== null){
                $id_employe = null;
                $conges = null;
                $motif = null;
                if (!empty($input['id_employe']) && !empty($input['conges'])){
                    $id_employe = $input['id_employe'];
                    $conges = $input['conges'];
                    $motif = $input['motif'];
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $user_model = new User_Model();
                $user_model->connection = new DatabaseConnection();
                $user_model->addCongesDispo($id_employe, $conges);
                
                $history_model = new User_Model();
                $history_model->connection = new DatabaseConnection();
                $history_model->addCongesHistorique($id, $id_employe, $conges, $motif);
            }
        }
        
        $user_model = new User_Model();
        $user_model->connection = new DatabaseConnection();
        $cruds = $user_model->getCrudUsers();
        
        $service_model = new Service_Model();
        $service_model->connection = new DatabaseConnection();
        $services = $service_model->getServices();
        
        $poste_model = new Poste_Model();
        $poste_model->connection = new DatabaseConnection();
        $postes = $poste_model->getPostes();
        
        if($_SESSION['id'] !== ""){
            require('templates/Users/index.php');
        }else{
            header("Location: index.php");
        }
    }
}