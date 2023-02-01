<?php
namespace Application\Model\Poste;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Poste
{
    public int $id_poste;
    public string $libelle;
}

class Poste_Model
{
        public DatabaseConnection $connection;
        
	public function createPoste(string $libelle)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO poste(libelle)
                VALUES(:libelle)'
                );
                $stmt->bindValue(':libelle', $libelle);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getPostes(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_poste, libelle FROM poste");
                
                $postes = [];
                while (($row = $stmt->fetch())) {
                    $poste = new Poste();
                    $poste->id_poste = $row['id_poste'];
                    $poste->libelle = $row['libelle'];

                    $postes[] = $poste;
                }

                return $postes;
        }
        
        public function deletePoste(int $id_poste){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM poste WHERE id_poste = :id_poste");
            $stmt->bindValue(':id_poste', $id_poste);
            $stmt->execute();
        }
        
        public function updatePoste(int $id_poste, string $libelle){
            $stmt = $this->connection->getConnection()->prepare("UPDATE poste SET libelle = :libelle
                                                                WHERE id_poste = :id_poste");
            $stmt->bindValue(':id_poste', $id_poste);
            $stmt->bindValue(':libelle', $libelle);
            $stmt->execute();
        }
}
