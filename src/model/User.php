<?php
namespace Application\Model\User;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class User
{
    public int $id_employe;
    public int $id_poste;
    public int $id_service;
    public string $nom;
    public string $prenom;
    public string $username;
    public string $email;
    public string $telephone;
    public string $password;
    public string $nomM;
    public string $prenomM;  
    public string $poste;  
    public string $service;
}

class User_Model
{
        public DatabaseConnection $connection;
        
	public function createUser(string $nom, string $prenom, string $username, string $email, string $telephone, string $password, int $id_poste, int $id_service)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO employe(nom, prenom, username, email, telephone, password, actif, id_poste, id_service)
                VALUES(:nom, :prenom, :username, :email, :telephone, :password, 1, :id_poste, :id_service)'
                );
                $stmt->bindValue(':nom', $nom);
                $stmt->bindValue(':prenom', $prenom);
                $stmt->bindValue(':username', $username);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':telephone', $telephone);
                $stmt->bindValue(':password', $password);
                $stmt->bindValue(':id_poste', $id_poste);
                $stmt->bindValue(':id_service', $id_service);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getUsers(){
            $stmt= $this->connection->getConnection()->query("SELECT * FROM employe");

            $users = [];
            while (($row = $stmt->fetch())) {
                $user = new User();
                $user->nom = $row['nom'];
                $user->prenom = $row['prenom'];
                $user->username = $row['username'];
                $user->email = $row['email'];
                $user->password = $row['password'];
                $user->id_poste = $row['id_poste'];
                $user->id_employe = $row['id_employe'];

                $users[] = $user;
            }
            return $users;
        }
        
        public function getUser(string $username, string $password){
            $res= $this->connection->getConnection()->prepare("SELECT * FROM employe
                                                            WHERE username = :username AND password = :password");
            $res->bindValue(':username',$username);
            $res->bindValue(':password',$password);
            $res->execute();

            $row = $res->fetch();

            if ($row === false) {
                return null;
            }
            $user = new User();
            $user->nom = $row['nom'];
            $user->prenom = $row['prenom'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->password = $row['password'];
            $user->id_poste = $row['id_poste'];
            $user->id_employe = $row['id_employe'];
            $user->id_service = $row['id_service'];

            return $user;
        }
        
        public function getUserPerso(int $id_employe){
            $res= $this->connection->getConnection()->prepare("SELECT id_employe, nom, prenom, username, email, 
                                                            P.libelle AS poste, S.libelle AS service, conges_dispo
                                                            FROM employe EM INNER JOIN poste P ON EM.id_poste = P.id_poste
                                                            INNER JOIN service S ON EM.id_service = S.id_service
                                                            WHERE id_employe = :id_employe");
            $res->bindValue(':id_employe', $id_employe);
            $res->execute();

            $row = $res->fetch();

            if ($row === false) {
                return null;
            }
            $user = new User();
            $user->nom = $row['nom'];
            $user->prenom = $row['prenom'];
            $user->username = $row['username'];
            $user->email = $row['email'];
            $user->id_employe = $row['id_employe'];
            $user->poste = $row['poste'];
            $user->service = $row['service'];
            $user->conges_dispo = $row['conges_dispo'];

            return $user;
        }
        
        public function getCrudUsers(){
            $stmt= $this->connection->getConnection()->query("
            SELECT id_employe, E.nom, E.prenom, username, E.email, P.libelle AS poste, 
            S.libelle AS service, telephone, E.id_service, E.id_poste, conges_dispo
            FROM employe E INNER JOIN poste P ON E.id_poste = P.id_poste
            INNER JOIN service S ON E.id_service = S.id_service
            WHERE actif = 1
            ORDER BY id_employe;
            ");

            $cruds = [];
            while (($row = $stmt->fetch())) {
                $crud = new User();
                $crud->id_employe = $row['id_employe'];
                $crud->nom = $row['nom'];
                $crud->prenom = $row['prenom'];
                $crud->username = $row['username'];
                $crud->email = $row['email'];
                $crud->poste = $row['poste'];
                $crud->id_poste = $row['id_poste'];
                $crud->id_service = $row['id_service'];
                $crud->service = $row['service'];
                $crud->telephone = $row['telephone'];
                $crud->conges_dispo = $row['conges_dispo'];

                $cruds[] = $crud;
            }

            return $cruds;
        }
        
        public function deleteUser(int $id_employe){
            $stmt = $this->connection->getConnection()->prepare("UPDATE employe SET actif = 0 WHERE id_employe = :id_employe");
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->execute();
        }
        
        public function addCongesDispo(int $id_employe, string $conges){
            $stmt = $this->connection->getConnection()->prepare("UPDATE employe SET conges_dispo = conges_dispo + :conges WHERE id_employe = :id_employe");
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->bindValue(':conges', $conges);
            $stmt->execute();
        }
        public function addCongesHistorique(int $id_admin, int $id_employe, string $conges, string $motif){
            $stmt = $this->connection->getConnection()->prepare("INSERT INTO historique_conges (date_ajout, nb_ajouter, motif, id_admin, id_employe)
                                                            VALUES (current_timestamp(), :conges, :motif, :id_admin, :id_employe)");
            $stmt->bindValue(':id_admin', $id_admin);
            $stmt->bindValue(':motif', $motif);
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->bindValue(':conges', $conges);
            $stmt->execute();
        }
        
        public function updateUser(int $id_employe, string $nom, string $prenom, string $username, string $email, string $telephone, string $password, int $poste, int $service){
            $stmt = $this->connection->getConnection()->prepare("UPDATE employe SET nom = :nom, prenom = :prenom, username = :username, email = :email,
                                                                telephone = :telephone, password = :password, id_poste = :poste, id_service = :service
                                                                WHERE id_employe = :id_employe");
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->bindValue(':nom', $nom);
            $stmt->bindValue(':prenom', $prenom);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':telephone', $telephone);
            $stmt->bindValue(':password', $password);
            $stmt->bindValue(':poste', $poste);
            $stmt->bindValue(':service', $service);
            $stmt->execute();
        }
}