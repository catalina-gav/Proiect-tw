<?php
require "fpdf.php";
$host = 'localhost';
 $db_name = 'gasm';
 $username = 'root';
 $password = '';
 $db = new PDO('mysql:host=localhost;dbname=gasm', 'root', '');
class myPDF extends FPDF{
    function header(){
        $this->Image('logo.png',10,5);
        $this->SetFont('Arial','B',14);
        $this->Cell(276,5,'GASM Info',0,0,'C');
        $this->Ln();
        $this->SetFont('Times','',12);
        $this->Cell(380,30,"Flowers Street, 9");
        $this->Ln(20);

    }

    function footer(){
        $this->SetY(-15);
        $this->SetFont('Arial','',8);
        $this->Cell(0,10,'Page' . $this->PageNo() . '/{nb}',0,0,'C');

    }

    function headerTable(){
        $this->SetFont('Times','B',12);
        $this->Cell(20,10,'Report ID',1,0,'C');
        $this->Cell(40,10,'City',1,0,'C');
        $this->Cell(45,10,'Neighbourhood',1,0,'C');
        $this->Cell(40,10,'Quantity',1,0,'C');
        $this->Cell(45,10,'Reported on this date',1,0,'C');
        $this->Cell(60,10,'Email to contact',1,0,'C');
        $this->Ln();

    }
    function viewTable($db){
        $this->SetFont('Times','',12);
        $stmt = $db->query("select * from notice_form");
        $stmt->execute();
        while($data = $stmt->fetch(PDO::FETCH_OBJ)){
            $this->Cell(20,10,$data->id,1,0,'C');
            $this->Cell(40,10,$data->city,1,0,'L');
            $this->Cell(45,10,$data->cartier,1,0,'L');
            $this->Cell(40,10,$data->trash,1,0,'L');
            $this->Cell(45,10,$data->notice_date,1,0,'L');
            $this->Cell(60,10,$data->email,1,0,'L');
            $this->Ln();
        }
    }


}

$pdf = new myPDF();
$pdf->AliasNbPages();
$pdf->AddPage('L','A4',0);
$pdf->headerTable();
$pdf->viewTable($db);
$pdf->Output();