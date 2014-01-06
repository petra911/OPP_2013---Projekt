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
		
		if (!empty($_POST["autor"]))
			$niz_autor = explode(",", $_POST["autor"]);
		if (!empty($_POST["naslov"]))
			$niz_naslov = explode(",", $_POST["naslov"]);
		if (!empty($_POST["keyword"]))
			$niz_keyword = explode(",", $_POST["keyword"]);                                 
                
		$autor = new \model\DBAutor();
		$znanstveni_rad = new \model\DBZnanstveniRad();
		$kljucne_rijeci = new \model\DBKljucneRijeci();   
                $obiljezen = new \model\DBObiljezen(); 
                $jeautor = new \model\DBJeAutor();    
                $skup = new \model\DBZnanstveniSkup();
                $casopis = new \model\DBZnanstveniCasopis();
                
                $radovi = array();
               
                // obradi unos autora
                // najveći je problem unos više autora gdje  gledam presjek radova zadanih autora
                // moguć je višestruki unos istog autora
                $i = 0;
                foreach ($niz_autor as $tmp) {
                    $rad_autor_tmp = $jeautor->select()->innerJoin("autor ON autor.idAutora = jeautor.idAutora"
                        )->innerJoin("znanstvenirad ON znanstvenirad.idRada = jeautor.idRada")->where(array("autor.prezime" => $tmp))->fetchAll();
                      
                    if ($i == 0) {
                        foreach ($rad_autor_tmp as $value) 
                            array_push($radovi, $value->idRada);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($rad_autor_tmp as $value)
                            array_push($temp, $value->idRada);
                        
                        $radovi = array_intersect($temp, $radovi);      
                        
                    }
                } 
                
                 // u ovom čuvam sve parove rada i ključne riječi za koje su unesene ključne riječi
                $i = 0;
                foreach ($niz_keyword as $tmp) {
                    $rad_keyword_tmp = $obiljezen->select()->innerJoin("kljucnerijeci ON kljucnerijeci.idTaga = obiljezen.idTaga"
                        )->innerJoin("znanstvenirad ON znanstvenirad.idRada = obiljezen.idRada")->where(array("kljucnerijeci.tag" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($rad_keyword_tmp as $value) 
                            array_push($radovi, $value->idRada);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($rad_keyword_tmp as $value)
                            array_push($temp, $value->idRada);
                        
                        $radovi = array_intersect($temp, $radovi);      
                        
                    }
                }  
                
                 // u ovom čuvam sve znanstvene radove tih naslova
                $i = 0;
                foreach ($niz_naslov as $tmp) {
                    $rad_znanstveni_tmp = $znanstveni_rad->select()->where(array(
                        "naslov" => $tmp
                    ))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_keyword) && ($i == 0)) { // ako nije ništa upisao u prošla dva polja i prvi je unos onda unesi radove u niz radovi
                        foreach ($rad_znanstveni_tmp as $value) 
                            array_push($radovi, $value->idRada);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($rad_znanstveni_tmp as $value)
                            array_push($temp, $value->idRada);
                        
                        $radovi = array_intersect($temp, $radovi);      
                        
                    }
                }                
                
                /* zapiši podatke u niz" */
                $radovi = array_unique($radovi, SORT_REGULAR);
               
               $data  = array (
                    "id" => array(), 
                    "imeautor" => array(),
                    "prezimeautor" => array(),
                    "naslov" => array(),
                    "sazetak" => array(),
                    "kljucnerijeci" => array(),
                    "skup" => array(),
                    "casopis" => array() 
                ); 
                               
                // za svaki idrada nađi ponovo autore i ključne riječi
                foreach($radovi as $value)
                {
                    $rad_keyword_tmp = $obiljezen->select()->innerJoin("kljucnerijeci ON kljucnerijeci.idTaga = obiljezen.idTaga"
                        )->where(array("obiljezen.idRada" => $value))->fetchAll(); 
                    
                    $rad_autor_tmp = $jeautor->select()->innerJoin("autor ON autor.idAutora = jeautor.idAutora"
                        )->where(array("jeautor.idRada" => $value))->fetchAll();
                      
                    //print_r($rad_keyword_tmp); echo "<br>";
                    //print_r($rad_autor_tmp); echo "<br>";
                    
                    /**************************/ // dodaj karakteristike znanstvenog rada
                     $tmp = $znanstveni_rad->select()->where(array(
                      "idRada" => $value
                        ))->fetchAll();                   
                   
                    
                    array_push($data["naslov"], $tmp[0]->naslov); 
                    array_push($data["sazetak"], $tmp[0]->sazetak); 
                    
                    // dodaj naziv skupa
                    $tmp1 = $skup->select()->where(array(
                      "idSkupa" => $tmp[0]->idSkupa
                        ))->fetchAll(); 
                    
                    if (count($tmp1))
                        array_push($data["skup"], $tmp1[0]->naziv);
                    
                    
                    // odaj naziv casopisa
                    $tmp1 = $casopis->select()->where(array(
                      "idCasopisa" => $tmp[0]->idCasopisa
                        ))->fetchAll(); 
                        
                    if (count($tmp1))
                        array_push($data["casopis"], $tmp1[0]->naziv);
                    
                    
                    /**************************/
                    
                    array_push($data["id"], $value); // dodaj id
                    
                    /************************/
                    $temp = array();
                    foreach ($rad_autor_tmp as $value) // dodaj autore
                    {                           
                            $tmp = $autor->select()->where(array(
                              "idAutora" => $value->idAutora
                            ))->fetchAll();
                            
                            $temp = array_unique(array_merge($temp,$tmp), SORT_REGULAR);                        
                                
                    }                   
                    
                    $s = '';
                    $s2 = '';
                    foreach ($temp as $value)
                    {
                        $s .= $value->prezime . ',';
                        $s2 .= $value->ime . ', ';
                    }

                    array_push($data["imeautor"], $s2);
                    array_push($data["prezimeautor"], $s);
                    
                    /*********************************/
                    $temp = array();
                    foreach ($rad_keyword_tmp as $value) // dodaj ključne riječi
                    {                           
                            $tmp = $kljucne_rijeci->select()->where(array(
                              "idTaga" => $value->idTaga
                            ))->fetchAll();
                            
                            $temp = array_unique(array_merge($temp,$tmp), SORT_REGULAR);                        
                                
                    }                   
                    
                    $s = '';                   
                    foreach ($temp as $value)
                    {
                        $s .= $value->tag . ',';                       
                    }
                    array_push($data["kljucnerijeci"], $s);  
                    
                    /*********************************/   
                }
                                 
                       
		echo new \view\Main(array(
                    "body" => new \view\RezultatiPretrazivanjaRadova(array(
                    "var" => $data
                     )),
                    "title" => "Rezultati pretraživanja radova"
                ));	
		
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
		
		if (!empty($_POST["autor"]))
			$niz_autor = explode(",", $_POST["autor"]);
		if (!empty($_POST["naziv"]))
			$niz_naziv = explode(",", $_POST["naziv"]);	
		if (!empty($_POST["parametar"]))
			$niz_parametar = explode(",", $_POST["parametar"]);
		if (!empty($_POST["vrijeme_pocetka"]))
			$niz_pocetak = explode(",", $_POST["vrijeme_pocetka"]);
		if (!empty($_POST["vrijeme_zavrsetka"]))
			$niz_zavrsetak = explode(",", $_POST["vrijeme_zavrsetka"]);
		if (!empty($_POST["iznosrez"]))
			$niz_iznosrezultata = explode(",", $_POST["iznosrez"]);	
		if (!empty($_POST["jedinicarez"]))
			$niz_jedinicarezultata = explode(",", $_POST["jedinicarez"]);
			/* dohvaćanje podataka iz tablica */
		
                /* dohvaćanje podataka iz tablica */
                 
                
		
		
                /*ispisivanje rezultata */
                echo new \view\Main(array(
                    "body" => new \view\RezultatiPretrazivanjaEksperimenata(array(
                    "var" => $data
                     )),
                    "title" => "Rezultati pretraživanja Eksperimenata"
                ));
		 
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
