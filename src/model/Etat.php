<?php
namespace Application\Model\Etat;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Etat
{
    public int $id_etat;
    public string $libelle;
}

class Etat_model
{
        public DatabaseConnection $connection;
        
	public function createEtat(string $libelle)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO etat(libelle)
                VALUES(:libelle)'
                );
                $stmt->bindValue(':libelle', $libelle);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getEtats(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_etat, libelle FROM etat");
                
                $etats = [];
                while (($row = $stmt->fetch())) {
                    $etat = new Etat();
                    $etat->id_etat = $row['id_etat'];
                    $etat->libelle = $row['libelle'];

                    $etats[] = $etat;
                }

                return $etats;
        }
        
        public function deleteEtat(int $id_etat){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM etat WHERE id_etat = :id_etat");
            $stmt->bindValue(':id_etat', $id_etat);
            $stmt->execute();
        }
        
        public function updateEtat(int $id_etat, string $libelle){
            $stmt = $this->connection->getConnection()->prepare("UPDATE etat SET libelle = :libelle
                                                                WHERE id_etat = :id_etat");
            $stmt->bindValue(':id_etat', $id_etat);
            $stmt->bindValue(':libelle', $libelle);
            $stmt->execute();
        }
}
