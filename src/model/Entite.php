<?php
namespace Application\Model\Entite;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Entite
{
    public int $id_entite;
    public string $libelle;
}

class Entite_Model
{
        public DatabaseConnection $connection;
        
	public function createEntite(string $libelle)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO entite(libelle)
                VALUES(:libelle)'
                );
                $stmt->bindValue(':libelle', $libelle);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getEntites(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_entite, libelle FROM entite");
                
                $entites = [];
                while (($row = $stmt->fetch())) {
                    $entite = new Entite();
                    $entite->id_entite = $row['id_entite'];
                    $entite->libelle = $row['libelle'];

                    $entites[] = $entite;
                }

                return $entites;
        }
        
        public function deleteEntite(int $id_entite){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM entite WHERE id_entite = :id_entite");
            $stmt->bindValue(':id_entite', $id_entite);
            $stmt->execute();
        }
        
        public function updateEntite(int $id_entite, string $libelle){
            $stmt = $this->connection->getConnection()->prepare("UPDATE entite SET libelle = :libelle
                                                                WHERE id_entite = :id_entite");
            $stmt->bindValue(':id_entite', $id_entite);
            $stmt->bindValue(':libelle', $libelle);
            $stmt->execute();
        }
}
