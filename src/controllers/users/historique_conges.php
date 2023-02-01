<?php

namespace Application\Controllers\CrudHistorique;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_Model;

class CrudHistorique
{
    
    public function CRUD(int $id_employe){
        
        $id = $id_employe;
        
        $historique_model = new Conges_Model();
        $historique_model->connection = new DatabaseConnection();
        $cruds = $historique_model->getCrudHistoriqueConges();
        
        if($_SESSION['id'] !== ""){
            require('templates/Users/historique_conges.php');
        }else{
            header("Location: index.php");
        }
    }
}