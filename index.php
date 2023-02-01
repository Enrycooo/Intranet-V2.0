<?php

session_start();
//On commence la session

if($_SESSION == null){
    //On défini les différentes variable à null si $_SESSION est vide
    $_SESSION['username']="";
    $_SESSION['password']="";
    $_SESSION['id']="";
    $_SESSION['id_poste']="";
    $_SESSION['id_service']="";
}

if($_SESSION['username'] !== "" && $_SESSION['password'] !== "" && $_SESSION['id'] !== ""){
    //Si l'on est connecté et que l'on essaie d'aller sur la page de connexion, on est rediriger sur la
    //page principale
    header("Location: index.php?action=connected&id=$id");
}

//On require tout les controllers
require_once('src/controllers/Login.php');
require_once('src/controllers/homepage.php');
require_once('src/controllers/mainpage.php');
require_once('src/controllers/navbar.php');
require_once('src/controllers/conges/createconges.php');
require_once('src/controllers/conges/crudconges.php');
require_once('src/controllers/users/cruduser.php');
require_once('src/controllers/admin/crudraison.php');
require_once('src/controllers/admin/crudservice.php');
require_once('src/controllers/admin/crudposte.php');
require_once('src/controllers/admin/crudetat.php');
require_once('src/controllers/calendar/calendar.php');
require_once('src/controllers/pdf.php');
require_once('src/controllers/conges/createcongesadmin.php');
require_once('src/controllers/perso/demandedeconges.php');
require_once('src/controllers/perso/infoperso.php');
require_once('src/controllers/users/historique_conges.php');

use Application\Controllers\Login\Login;
use Application\Controllers\Homepage\Homepage;
use Application\Controllers\Mainpage\Mainpage;
use Application\Controllers\Navbar\Navbar;
use Application\Controllers\CreateConges\CreateConges;
use Application\Controllers\CrudConges\CrudConges;
use Application\Controllers\CrudUser\CrudUser;
use Application\Controllers\CrudRaison\CrudRaison;
use Application\Controllers\CrudService\CrudService;
use Application\Controllers\CrudPoste\CrudPoste;
use Application\Controllers\CrudEtat\CrudEtat;
use Application\Controllers\Calendar\Calendar;
use Application\Controllers\PDF\PDF;
use Application\Controllers\CreateCongesAdmin\CreateCongesAdmin;
use Application\Controllers\DemandeDeConges\DemandeConges;
use Application\Controllers\InfoPerso\InfoPerso;
use Application\Controllers\CrudHistorique\CrudHistorique;


try {
    //On vérifie que action n'est pas nul
    if (isset($_GET['action']) && $_GET['action'] !== '') {
        //si il est pas nul alors on vérifie si action = connection
        if ($_GET['action'] === 'connection') {
            //Si oui on execute alors le code juste en dessous
            (new Login())->execute($_POST);
            //Si non, on vérifie que action soit égal à une autre action (par exemple connected)
        }elseif($_GET['action'] === 'connected'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
            (new Navbar())->execute();
                (new Mainpage())->execute();
            } else {
                throw new Exception('Erreur de connexion au site');
            }
        }elseif($_GET['action'] === 'createConges'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
            (new Navbar())->execute();
            (new CreateConges())->execute($input, $id_employe);
            } else {
                throw new Exception('Erreur de pa');
            }
        }elseif($_GET['action'] === 'createCongesAdmin'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
            (new Navbar())->execute();
            (new CreateCongesAdmin())->execute($input, $id_employe);
            } else {
                throw new Exception('Erreur de pa');
            }
        }elseif($_GET['action'] === 'crudconges' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudConges())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudusers' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudUser())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudRaison' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudRaison())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudService' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudService())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudPoste' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudPoste())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudEtat' && $_SESSION['id_poste'] !== 2){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new CrudEtat())->CRUD($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'calendarconges'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                $input = null;
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $input = $_POST;
                }
                
                (new Navbar())->execute();
                (new Calendar())->Calendar($id_employe, $input);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'pdf'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                $id_conges = $_GET['id_conges'];
                
                (new PDF())->PDF($id_employe, $id_conges);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'demandedeconges'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                (new Navbar())->execute();
                (new DemandeConges())->Demande($id_employe);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'crudhistorique'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                (new Navbar())->execute();
                (new CrudHistorique())->CRUD($id_employe);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'infoperso'){
            if (isset($_GET['id']) && $_GET['id'] > 0) {
                $id_employe = $_GET['id'];
                
                (new Navbar())->execute();
                (new InfoPerso())->Info($id_employe);
            } else {
                throw new Exception('Erreur de ma');
            }
        }elseif($_GET['action'] === 'deconnection'){
            (new Mainpage())->logout();
        }else {
            //Lorsque action n'est égal à rien, on indique que la page recherchez n'existe pas
            (new Navbar())->execute();
            throw new Exception("La page que vous recherchez n'existe pas.");
        }
    } else {
        //Si action est vide on nous redirige sur la page principale
        if($_SESSION['id'] !== ""){
            //si l'on est connecté la page principale de l'intranet
            $id = $_SESSION['id'];
            header("Location: index.php?action=connected&id=$id");
        }elseif($_SESSION['id'] == ""){
            //si l'on est pas connecté, sur la page de connexion
            header('Location= index.php');
        (new Homepage())->execute();
        }
    }
} catch (Exception $e) {
    //si l'on a rencontré une erreur, l'erreur est envoyé à error.php qui vas ensuite nous être affiché
    //en empêchant l'action désiré
    $errorMessage = $e->getMessage();

    require('templates/error.php');
}