<?php

namespace Application\Controllers\CrudLog;

require_once('src/lib/database.php');
require_once('src/model/user.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class CrudLog
{
    
    public function CRUD(int $id_employe){
        
        $id = $id_employe;
        
        $log_model = new User_Model();
        $log_model->connection = new DatabaseConnection();
        $cruds = $log_model->getCrudLog();
        
        if($_SESSION['id'] !== ""){
            require('templates/log/log_connexion.php');
        }else{
            header("Location: index.php");
        }
    }
}