<?php

namespace model;
use opp\model\Model;

class PDFModel extends \FPDF {
    private $naziv;
    
    public function Header()
    {
        $this->SetFont('Arial','B',15);
        // Move to the right
        $this->Cell(80);
        // Title
        $this->Cell(30,10,$this->naziv,1,0,'C');
        // Line break
        $this->Ln(20);
    }
    
    // Page footer
    public function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
    
    public function displayPDFEksperimenta() {
        
    }

    
    public function generirajIzvjesce() {
        // dogovor s Ivanom
    }
    
    public function generirajIspis() {
        // dogovor s Tihomirom
    }
    
    public function displayPDF() {
        // trebas dobiti lokaciju na posluzitelju gdje se nalazi pdf
        // i prikazati ga na ekranu (preko View-a DisplayPDF (trebas ga sam napraviti)
        // ako biblioteka rradi na ddrugaciji nacin javi
    }
    
    public function setNaziv($naziv) {
        $this->naziv = $naziv;
        return $this;
    }

}
