<?php

namespace ctl;
use opp\controller\Controller;

class Pretrazivanje implements Controller {
    private $errorMessage;
    
    public function pretraziRadove() {
        /**
         * ovdje trebas provjeriti je li ista uneseno ako je parsirati, te pretraziti bazu podataka a zatim dobivene rezultate prenijeti u view RezultatiPretrazivanjaRadova
         * i prikazati ih
         */
		$niz_autor = array();
		$niz_naslov = array();
		$niz_keyword = array();
		
		if (!empty($_POST["autor"])
			$niz_autor = explode(",", $_POST["autor"]);
		if (!empty($_POST["naslov"])
			$niz_naslov = explode(",", $_POST["naslov"]);
		if (!empty($_POST["keyword"])
			$niz_keyword = explode(",", $_POST["keyword"]);

		/*
		$autor = new \model\DBAutor();
		$znanstveni_rad = new \model\DBZnanstveniRad();
		$kljucne_rijeci = new \model\DBKljucneRijeci();*/
		
		/* dohvaćanje podataka iz tablica */
		$data =  
		
		$view = new \view\RezultatiPretrazivanjaRadova;
		return $view->outputHTML($data);
		
		
    }
    
    public function pretraziEksperimente() {
		
        /**
         * ovdje trebas provjeriti je li ista uneseno ako je parsirati, te pretraziti bazu podataka a zatim dobivene rezultate prenijeti u view RezultatiPretrazivanjaEksperimenata
         * i prikazati ih -> konLukom
         */
		$niz_autor = array();
		$niz_naziv = array();
		$niz_parametar = array();
		$niz_pocetak = array();
		$niz_zavrsetak = array();
		$niz_iznosrezultata = array();
		$niz_jedinicarezultata = array();
		
		if (!empty($_POST["autor"])
			$niz_autor = explode(",", $_POST["autor"]);
		if (!empty($_POST["naziv"])
			$niz_naziv = explode(",", $_POST["naziv"]);	
		if (!empty($_POST["parametar"])
			$niz_parametar = explode(",", $_POST["parametar"]);
		if (!empty($_POST["vrijeme_pocetka"])
			$niz_pocetak = explode(",", $_POST["vrijeme_pocetka"]);
		if (!empty($_POST["vrijeme_zavrsetka"])
			$niz_zavrsetak = explode(",", $_POST["vrijeme_zavrsetka"]);
		if (!empty($_POST["iznosrez"])
			$niz_iznosrezultata = explode(",", $_POST["iznosrez"]);	
		if (!empty($_POST["jedinicarez"])
			$niz_jedinicarezultata = explode(",", $_POST["jedinicarez"]);
			/* dohvaćanje podataka iz tablica */
		
		$data = 
		
		 $view = new \view\RezultatiPretrazivanjaEksperimenata;
		 return $view->outputHTML($data);
		 
    }
    
    public function displayPretrazivanjeRadova() {
        // ako si ukucao url a ovlaštena si osoba
        if(isset($_SESSION['vrsta']) && $_SESSION['vrsta'] == 'O') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        echo new \view\Main(array(
            "body" => new \view\PretrazivanjeRadova(array(
                "errorMessage" => $this->errorMessage
            )),
            "title" => "Pretraživanje Znanstvenih Radova"
        ));
    }
    
    public function displayPretrazivanjeEksperimenata() {
        /**
         * analogno gornjem
         */
		 if(isset($_SESSION['vrsta']) && $_SESSION['vrsta'] == 'O') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        echo new \view\Main(array(
            "body" => new \view\PretrazivanjeEksperimenata(array(
                "errorMessage" => $this->errorMessage
            )),
            "title" => "Pretraživanje Znanstvenih Eksperimenata"
        ));
    }
}
