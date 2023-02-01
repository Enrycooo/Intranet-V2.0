<?php
namespace Application\Model\Service;

require_once('src/lib/database.php');

use Application\Lib\Database\DatabaseConnection;

class Service
{
    public int $id_service;
    public string $libelle;
}

class Service_model
{
        public DatabaseConnection $connection;
        
	public function createService(string $libelle)
	{
                $stmt = $this->connection->getConnection()->prepare(
                'INSERT INTO service(libelle)
                VALUES(:libelle)'
                );
                $stmt->bindValue(':libelle', $libelle);
                $affectedLines = $stmt->execute();

                return ($affectedLines > 0);
	}
        
        public function getServices(): array {
            
                $stmt= $this->connection->getConnection()->query("SELECT id_service, libelle FROM service");
                
                $services = [];
                while (($row = $stmt->fetch())) {
                    $service = new Service();
                    $service->id_service = $row['id_service'];
                    $service->libelle = $row['libelle'];

                    $services[] = $service;
                }

                return $services;
        }
        
        public function deleteService(int $id_service){
            $stmt = $this->connection->getConnection()->prepare("DELETE FROM service WHERE id_service = :id_service");
            $stmt->bindValue(':id_service', $id_service);
            $stmt->execute();
        }
        
        public function updateService(int $id_service, string $libelle){
            $stmt = $this->connection->getConnection()->prepare("UPDATE service SET libelle = :libelle
                                                                WHERE id_service = :id_service");
            $stmt->bindValue(':id_service', $id_service);
            $stmt->bindValue(':libelle', $libelle);
            $stmt->execute();
        }
}