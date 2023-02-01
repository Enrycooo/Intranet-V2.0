<?php

namespace Application\Controllers\PDF;

require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_Model;

class PDF
{
    public function PDF(int $id_employe, int $id_conges){
        $id = $id_employe;
        
        $pdfModel = new Conges_Model();
        $pdfModel->connection = new DatabaseConnection();
        $pdf = $pdfModel->getPDF($id_conges);
        
        if($_SESSION['id'] !== ""){
            require('templates/pdf/pdf.php');
        }else{
            header("Location: index.php");
        }
    }
}