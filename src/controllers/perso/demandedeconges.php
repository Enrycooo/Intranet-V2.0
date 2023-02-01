<?php

namespace Application\Controllers\DemandeDeConges;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_Model;

class DemandeConges
{
    public function Demande(int $id_employe){
        
        $id = $id_employe;
        
        $crudModel = new Conges_Model();
        $crudModel->connection = new DatabaseConnection();
        $cruds = $crudModel->getConge($id);
        
        if($_SESSION['id'] !== ""){
            require('templates/perso/demandedeconges.php');
        }else{
            header("Location: index.php");
        }
    }
}