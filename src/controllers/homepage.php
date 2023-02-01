<?php
namespace Application\Controllers\Homepage;

require_once('src/lib/database.php');
require_once('src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class Homepage
{
    public function execute()
    {
        $User_model = new User_model();
        $User_model->connection = new DatabaseConnection();
        $users = $User_model->getUsers();
        
        require('templates/homepage.php');
    }
}
