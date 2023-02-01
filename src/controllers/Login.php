<?php
//On nomme ce fichier dans l'arborescence fictive
namespace Application\Controllers\Login;

//On require le model et la base de données
require_once('src/lib/database.php');
require_once('src/model/User.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\User\User_Model;

class Login{
	
	public function execute(array $input)
	{
                $username = null;
                $password = null;
                if (!empty($input['username']) && !empty($input['password'])) {
                    //On vérifie les valeurs saisies dans les inputs de connexion
                    $username = $input['username'];
                    $password = crypt($input['password'],'$6$rounds=5000$gA6Fkf92AFMpn3cGK$');
                    echo $password;
                } else {
                    throw new \Exception('Les données du formulaire sont invalides.');
                }
                $userModel = new User_Model();
                $userModel->connection = new DatabaseConnection();
                //Connexion à la BDD
                $users = $userModel->getUser($username,$password);
                //On envoie $username et $password à la fonction getUser et si la requête retourner
                //l'array souhaité, alors elle est stocké dans la variable $users
                
                if($users) // nom d'utilisateur et mot de passe correctes
                {
                    //On attribut au variable $_SESSION des valeurs
                        $_SESSION['username'] = $username;
                        $_SESSION['id'] = $users->id_employe;
                        $_SESSION['id_poste'] = $users->id_poste;
                        $_SESSION['id_service'] = $users->id_service;
                        $id = $_SESSION['id'];
                        $poste = $_SESSION['id_poste'];
                        header("Location: index.php?action=connected&id=$id");
                }else{
                    throw new \Exception('Votre compte est désactivée ou alors le nom d\'utilisateur et/ou le mot de passe sont incorrectes !');
                }
        }
}