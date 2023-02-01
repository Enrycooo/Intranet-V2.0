<?php
namespace Application\Model\Conges;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Conge
{
    public int $id_conges;
    public int $id_employe;
    public int $id_raison;
    public int $id_etat;
    public int $id;
    public string $date_debut;
    public string $date_fin;
    public string $duree;
    public string $commentaire;
    public string $libelle;
    public string $raison;
    public string $etat;
    public string $employe;
    public string $debut_type;
    public string $fin_type;
    public string $title;
    public string $start_date;
    public string $end_date;
    public string $nom;
    public string $prenom;
}

class Conges_Model
{
        public DatabaseConnection $connection;
        
	public function createConge(int $id_employe, int $id_raison, string $date_debut, string $date_fin, string $debut_type, string $fin_type, string $duree, string $commentaire)
	{
                $stmt = $this->connection->getConnection()->prepare(
                "INSERT INTO conges(id_employe, id_raison, id_etat, date_debut, date_fin, debut_type, fin_type, duree, commentaire)
                VALUES(:id_employe, :id_raison, 2, :date_debut, :date_fin, :debut_type, :fin_type, :duree, :commentaire)"
                );
                
                $stmt->bindValue(':id_employe', $id_employe);
                $stmt->bindValue(':id_raison', $id_raison);
                $stmt->bindValue(':date_debut', $date_debut);
                $stmt->bindValue(':date_fin', $date_fin);
                $stmt->bindValue(':debut_type', $debut_type);
                $stmt->bindValue(':fin_type', $fin_type);
                $stmt->bindValue(':duree', $duree);
                $stmt->bindValue(':commentaire', $commentaire);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function createCongeAdmin(int $id_employe, int $id_raison, string $date_debut, string $date_fin, string $debut_type, string $fin_type, string $duree, string $commentaire)
	{
                $stmt = $this->connection->getConnection()->prepare(
                "INSERT INTO conges(id_employe, id_raison, id_etat, date_debut, date_fin, debut_type, fin_type, duree, commentaire)
                VALUES(:id_employe, :id_raison, 2, :date_debut, :date_fin, :debut_type, :fin_type, :duree, :commentaire)"
                );
                
                $stmt->bindValue(':id_employe', $id_employe);
                $stmt->bindValue(':id_raison', $id_raison);
                $stmt->bindValue(':date_debut', $date_debut);
                $stmt->bindValue(':date_fin', $date_fin);
                $stmt->bindValue(':debut_type', $debut_type);
                $stmt->bindValue(':fin_type', $fin_type);
                $stmt->bindValue(':duree', $duree);
                $stmt->bindValue(':commentaire', $commentaire);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getConge(int $id_employe){
            $stmt = $this->connection->getConnection()->prepare("SELECT id_conges, date_debut, date_fin, commentaire, duree, R.libelle AS raison, 
                                                                E.libelle AS etat, C.debut_type, C.fin_type, C.id_raison, C.id_etat
                                                                FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison
                                                                INNER JOIN etat E ON C.id_etat = E.id_etat
                                                                INNER JOIN employe EM ON C.id_employe = EM.id_employe
                                                                WHERE C.id_employe = :id_employe
                                                                ORDER BY date_demande DESC;");
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->execute();
            
            $cruds = [];
                while (($row = $stmt->fetch())) {
                    $date_debut = date("d-m-Y H:i", strtotime($row['date_debut']));
                    $date_fin = date("d-m-Y H:i", strtotime($row['date_fin']));
                    $crud = new Conge();
                    $crud->id_conges = $row['id_conges'];
                    $crud->date_debut = $date_debut;
                    $crud->date_fin = $date_fin;
                    $crud->commentaire = $row['commentaire'];
                    $crud->duree = $row['duree'];
                    $crud->raison = $row['raison'];
                    $crud->etat = $row['etat'];
                    $crud->debut_type = $row['debut_type'];
                    $crud->fin_type = $row['fin_type'];
                    $crud->id_raison = $row['id_raison'];
                    $crud->id_etat = $row['id_etat'];
                    
                    $cruds[] = $crud;
                }
                return $cruds;
        }
        
        public function getCrudConges(){
                $stmt= $this->connection->getConnection()->query("
                    SELECT id_conges, date_debut, date_fin, commentaire, duree, R.libelle AS raison, 
                    E.libelle AS etat, EM.nom, EM.prenom, C.debut_type, C.fin_type, C.id_raison, C.id_etat
                    FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison
                    INNER JOIN etat E ON C.id_etat = E.id_etat
                    INNER JOIN employe EM ON C.id_employe = EM.id_employe
                    ORDER BY date_demande DESC;
                    ");
                
                $cruds = [];
                while (($row = $stmt->fetch())) {
                    $date_debut = date("d-m-Y H:i", strtotime($row['date_debut']));
                    $date_fin = date("d-m-Y H:i", strtotime($row['date_fin']));
                    $crud = new Conge();
                    $crud->id_conges = $row['id_conges'];
                    $crud->date_debut = $date_debut;
                    $crud->date_fin = $date_fin;
                    $crud->commentaire = $row['commentaire'];
                    $crud->duree = $row['duree'];
                    $crud->raison = $row['raison'];
                    $crud->etat = $row['etat'];
                    $crud->nom = $row['nom'];
                    $crud->prenom = $row['prenom'];
                    $crud->debut_type = $row['debut_type'];
                    $crud->fin_type = $row['fin_type'];
                    $crud->id_raison = $row['id_raison'];
                    $crud->id_etat = $row['id_etat'];
                    
                    $cruds[] = $crud;
                }
                
                return $cruds;
        }
        
        public function getCrudHistoriqueConges(){
                $stmt= $this->connection->getConnection()->query("
                    SELECT id, date_ajout, nb_ajouter, motif, H.id_admin, H.id_employe,
                    EM.nom AS admin_nom, EM.prenom AS admin_prenom, EM2.nom AS emp_nom,
                    EM2.prenom AS emp_prenom
                    FROM historique_conges H INNER JOIN employe EM ON H.id_admin = EM.id_employe
                    INNER JOIN employe EM2 ON H.id_employe = EM2.id_employe
                    ORDER BY date_ajout DESC;
                    ");
                
                $cruds = [];
                while (($row = $stmt->fetch())) {
                    $crud = new Conge();
                    $crud->id_historique = $row['id'];
                    $crud->date_ajout = $row['date_ajout'];
                    $crud->nb_ajouter = $row['nb_ajouter'];
                    $crud->motif = $row['motif'];
                    $crud->id_admin = $row['id_admin'];
                    $crud->id_employe = $row['id_employe'];
                    $crud->admin_nom = $row['admin_nom'];
                    $crud->admin_prenom = $row['admin_prenom'];
                    $crud->emp_nom = $row['emp_nom'];
                    $crud->emp_prenom = $row['emp_prenom'];
                    $cruds[] = $crud;
                }
                
                return $cruds;
        }
        
        public function getCalendar(){
                $stmt= $this->connection->getConnection()->query("
                    SELECT id_conges, date_debut, date_fin, R.libelle AS raison
                    FROM conges C INNER JOIN raison R ON C.id_raison=R.id_raison
                    ");
                
                $calendars = [];
                while (($row = $stmt->fetch())) {
                $calendar = new Conge();
                $calendar->id = $row['id_conges'];
                $calendar->title = $row['raison'];
                $calendar->start_date = $row['date_debut'];
                $calendar->end_date = $row['date_fin'];
                
                $calendars[] = $calendar;
                }
            return $calendars;
        }
        
        public function deleteConges(int $id_conges){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM conges WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->execute();
        }
        
        public function updateConges(int $id_conges, int $id_raison, int $id_etat, string $date_debut, string $date_fin, string $debut_type, string $fin_type, string $duree, string $commentaire){
            $stmt = $this->connection->getConnection()->prepare("UPDATE conges SET id_raison = :id_raison, id_etat = :id_etat, date_debut = :date_debut, date_fin = :date_fin, debut_type = :debut_type, 
                                                                fin_type = :fin_type, duree = :duree, commentaire = :commentaire, date_change = CURRENT_TIMESTAMP
                                                                WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->bindValue(':id_raison', $id_raison);
            $stmt->bindValue(':id_etat', $id_etat);
            $stmt->bindValue(':date_debut', $date_debut);
            $stmt->bindValue(':date_fin', $date_fin);
            $stmt->bindValue(':debut_type', $debut_type);
            $stmt->bindValue(':fin_type', $fin_type);
            $stmt->bindValue(':duree', $duree);
            $stmt->bindValue(':commentaire', $commentaire);
            $stmt->execute();
        }
        
        public function getPdf(int $id_conges){
            $stmt = $this->connection->getConnection()->prepare("SELECT C.id_conges, C.id_employe, C.id_raison, date_debut, date_fin,
                                                                EM.nom AS nom, EM.prenom AS prenom, R.libelle AS raison, commentaire,
                                                                duree, C.id_raison, date_demande, date_change, E.libelle AS etat
                                                                FROM conges C INNER JOIN employe EM ON C.id_employe = EM.id_employe
                                                                INNER JOIN raison R ON C.id_raison=R.id_raison
                                                                INNER JOIN etat E ON C.id_etat=E.id_etat
                                                                WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->execute();
            
            $row = $stmt->fetch();
            $pdf = new Conge();
            $pdf->date_debut = $row['date_debut'];
            $pdf->date_fin = $row['date_fin'];
            $pdf->commentaire = $row['commentaire'];
            $pdf->nom = $row['nom'];
            $pdf->prenom = $row['prenom'];
            $pdf->raison = $row['raison'];
            $pdf->duree = $row['duree'];
            $pdf->id_raison = $row['id_raison'];
            $pdf->etat = $row['etat'];
            $pdf->date_demande = date('d-m-Y', strtotime($row['date_demande']));
            $pdf->date_change = date('d-m-Y', strtotime($row['date_change']));
            
            return $pdf;
        }
        
        public function changeEtat(int $id_conges, int $id_etat){
            $stmt = $this->connection->getConnection()->prepare("UPDATE conges SET id_etat = :id_etat, date_change = CURRENT_TIMESTAMP
                                                                WHERE id_conges = :id_conges");
            $stmt->bindValue(':id_conges', $id_conges);
            $stmt->bindValue(':id_etat', $id_etat);
            $stmt->execute();
        }
        
        //Cette fonction va retirer le nombre de jours de conges pris des conges dispo de l'employé
        public function DeleteCongesPris(int $id_employe, string $duree){
            $stmt = $this->connection->getConnection()->prepare("UPDATE employe SET conges_dispo = conges_dispo - :duree
                                                                WHERE id_employe = :id_employe");
            $stmt->bindValue(':id_employe', $id_employe);
            $stmt->bindValue(':duree', $duree);
            $stmt->execute();
        }
}