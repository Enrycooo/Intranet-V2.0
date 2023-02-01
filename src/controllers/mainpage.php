<?php

namespace Application\Controllers\Mainpage;

class Mainpage
{
    public function logout()
	{
                //Si l'on fait appel à cette fonction, elle vide $_SESSION de toutes ses valeurs
                //Elle redirige ensuite sur la page de connexion (c'est une déconnexion)
                session_destroy();
		header('location: index.php');
		exit;
	}
    
    public function execute()
    {
        if($_SESSION['username'] !== ""){
            require('templates/mainpage.php');
        }else{
            header("Location: index.php");
        }
    }
}
