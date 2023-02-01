<?php

namespace Application\Controllers\InfoPerso;

require_once('src/lib/database.php');
require_once('src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class InfoPerso
{
    
    public function Info(int $id_employe){
        
        $id = $id_employe;
        
        $user_model = new User_Model();
        $user_model->connection = new DatabaseConnection();
        $cruds = $user_model->getUserPerso($id);
        
        if($_SESSION['id'] !== ""){
            require('templates/perso/infoperso.php');
        }else{
            header("Location: index.php");
        }
    }
}