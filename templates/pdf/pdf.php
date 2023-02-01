<?php
require('fpdf.php');
require_once('src/lib/database.php');
require_once('src/model/Conges.php');

use Application\Lib\Database\DatabaseConnection;
use Application\Model\Conges\Conges_Model;

$id_conges = $_GET['id_conges'];
    $pdfModel = new Conges_Model();
    $pdfModel->connection = new DatabaseConnection();
    $model = $pdfModel->getPDF($id_conges);

class PDF extends FPDF
{
// En-tête
public function Header()
{
    $id_conges = $_GET['id_conges'];
    $pdfModel = new Conges_Model();
    $pdfModel->connection = new DatabaseConnection();
    $model = $pdfModel->getPDF($id_conges);
    
    // Logo
    $this->Image('assets/img/LOGO_1.png',14,15,80);
    // Police Arial gras 15
    $this->SetFont('Arial','',10);
    // Saut de ligne
    $this->Ln(30);
    //NOM
    // SetX = Décalage à droite pour écrire les cellule côte à côte
    $this->SetX(28);
    $this->Cell(0,0,'Nom : '.$model->nom.'',0,1);
    $this->SetX(120);
    //Prénom
    $this->MultiCell(50,0,'Prenom : '.$model->prenom.'',0,1);
    // Titre
    $this->Ln(20);
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(211, 211, 211); // Définit la couleur de remplissage en rouge
    $this->Cell(190,6,'DEMANDE DE CONGE / ABSENCE',1,0,'C',1);
    // Saut de ligne
    $this->Ln(20);
}
// Pied de page
function Footer()
{
    $id_conges = $_GET['id_conges'];
    $pdfModel = new Conges_Model();
    $pdfModel->connection = new DatabaseConnection();
    $model = $pdfModel->getPDF($id_conges);
    
    $this->SetFont('Arial','B',10);
    $this->SetFillColor(211, 211, 211);
    $this->Cell(190,6,'',1,0,'C',1);
    $this->SetFont('Arial','',10);
    $this->Ln(20);
    $this->SetX(28);
    $this->Cell(0,0,'Signature responsable',0,1);
    $this->SetX(90);
    $this->MultiCell(50,0,'Signature du Directeur',0,1);
    $this->SetX(150);
    $this->MultiCell(50,0,'Signature de l\'agent',0,1);
    $this->Ln(5);
    $this->SetX(28);
    $this->Cell(0,0,'Date ..........................',0,1);
    $this->SetX(90);
    if($model->date_change == '01-01-1970'){
        $this->Cell(0,0,'Date ............................',0,1);
    } else{
        $this->Cell(0,0,'Date '.$model->date_change.'',0,1);
    }
    $this->SetX(150);
    $this->Cell(0,0,'Date '.$model->date_demande.'',0,1);
    $this->Ln(30);
    $this->SetFont('Arial','B',8);
    $this->Cell(190,6,'Les demandes de conges doivent etre deposees 48 heures au moins a l\'avance pour les absences n\'excedant pas',0,0,'C');
    $this->Ln(3);
    $this->Cell(190,6,'2 jours et 15 jours dans les autres cas',0,0,'C');
    $this->Ln(7);
    $this->SetX(85);
    $this->Cell(190,6,'Mail :',0,0,'');
    $this->SetX(93);
    $this->SetFont('Arial','BU',8);
    $this->SetTextColor(0, 0, 139); //Permet de modifier la couleur d'un text
    $this->Cell(190,6,'jlemoine@landrysa.com',0,0,'');
    $this->Ln(3.5);
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0, 0, 0);
    $this->SetX(80.25);
    $this->Cell(190,6,'Copie a :',0,0,'');
    $this->SetX(93);
    $this->SetFont('Arial','BU',8);
    $this->SetTextColor(0, 0, 139);
    $this->Cell(190,6,'jpalanchier@landrysa.com',0,0,'');
    $this->Ln(3.5);
    $this->SetFont('Arial','B',8);
    $this->SetTextColor(0, 0, 0);
    $this->Cell(190,6,'Fax : 05 08 41 19 21',0,0,'C');
}
}

// Instanciation de la classe dérivée
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial','BU',12);
$pdf->Cell(190,6,' Nature du conge :',0,0);
    $raison = $model->id_raison;
    $motif = $model->raison;
    $date_debut = date("d-m-Y H:i", strtotime($model->date_debut));
    $date_fin = date("d-m-Y H:i", strtotime($model->date_fin));
    if($raison == 1 || $raison == 2 || $raison == 3){
        $pdf->Image('assets/img/checkbox-cocher.png', 12, 100, 3);
        $pdf->Ln(22);
        $pdf->SetX(15);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,' Conge maladie ou maternite/paternite',0,0);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Nbre de jours :     '.$model->duree.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Du '.$date_debut.' au '.$date_fin.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(111);
        $pdf->Cell(0,0,'Demande : '.$model->etat.'',0,0);
    }
    elseif($raison == 4){
        $pdf->Image('assets/img/checkbox-cocher.png', 12, 100, 3);
        $pdf->Ln(22);
        $pdf->SetX(15);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,' Conge Annuel',0,0);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Nbre de jours :     '.$model->duree.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Du '.$date_debut.' au '.$date_fin.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(111);
        $pdf->Cell(0,0,'Demande : '.$model->etat.'',0,0);
    }elseif($raison == 5 || $raison == 6){
        $pdf->Image('assets/img/checkbox-cocher.png', 12, 100, 3);
        $pdf->Ln(22);
        $pdf->SetX(15);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,' Autorisation d\'absence',0,0);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Nbre de jours :     '.$model->duree.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(15);
        $pdf->Cell(0,0,' Motif :     '.$motif.'',0,0);
        $pdf->SetX(110);
        $pdf->Cell(0,0,' Du '.$date_debut.' au '.$date_fin.'',0,0);
        $pdf->Ln(7);
        $pdf->SetX(111);
        $pdf->Cell(0,0,'Demande : '.$model->etat.'',0,0);
    }
$pdf->Ln(90);
$date = $model->date_demande;
$pdf->Output('Demande_de_conges_de_'.$model->nom.'_'.$model->prenom.'_du_'.$date.'.pdf', 'D');