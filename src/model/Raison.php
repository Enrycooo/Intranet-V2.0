<?php
namespace Application\Model\Raison;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Raison
{
    public int $id_raison;
    public string $libelle;
}

class Raison_model
{
        public DatabaseConnection $connection;
        
	public function createRaison(string $libelle)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO raison(libelle)
                VALUES(:libelle)'
                );
                $stmt->bindValue(':libelle', $libelle);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getRaisons(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_raison, libelle FROM raison");
                
                $raisons = [];
                while (($row = $stmt->fetch())) {
                    $raison = new Raison();
                    $raison->id_raison = $row['id_raison'];
                    $raison->libelle = $row['libelle'];

                    $raisons[] = $raison;
                }

                return $raisons;
        }
        
        public function deleteRaison(int $id_raison){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM raison WHERE id_raison = :id_raison");
            $stmt->bindValue(':id_raison', $id_raison);
            $stmt->execute();
        }
        
        public function updateRaison(int $id_raison, string $libelle){
            $stmt = $this->connection->getConnection()->prepare("UPDATE raison SET libelle = :libelle
                                                                WHERE id_raison = :id_raison");
            $stmt->bindValue(':id_raison', $id_raison);
            $stmt->bindValue(':libelle', $libelle);
            $stmt->execute();
        }
}