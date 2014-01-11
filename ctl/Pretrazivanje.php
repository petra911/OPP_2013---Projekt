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
                     
                      /**************************/
                    
                    array_push($data["id"], $value); // dodaj id
                   
                    /******************************/ // dodaj naslov i sažetak
                    
                    array_push($data["naslov"], $tmp[0]->naslov); 
                    array_push($data["sazetak"], $tmp[0]->sazetak); 
                    
                    // dodaj naziv skupa
                    $tmp1 = $skup->select()->where(array(
                      "idSkupa" => $tmp[0]->idSkupa
                        ))->fetchAll(); 
                    
                    if (count($tmp1))
                        array_push($data["skup"], $tmp1[0]->naziv);
                    else
                        array_push($data["skup"], '-');
                    
                    
                    // dodaj naziv casopisa
                    $tmp1 = $casopis->select()->where(array(
                      "idCasopisa" => $tmp[0]->idCasopisa
                        ))->fetchAll(); 
                        
                    if (count($tmp1))
                        array_push($data["casopis"], $tmp1[0]->naziv);
                    else
                        array_push($data["casopis"], '-');                  
                    
                   
                    
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
                    if (count($temp))
                    {
                                              
                        foreach ($temp as $value)
                        {
                            $s .= $value->ime . ' ' .$value->prezime . ', ';                           
                        }                                          
                    }
                    else
                    {
                        $s = '-';                        
                    }
                    
                    if (strlen($s) > 1)
                        $s = substr($s, 0, -2);
                    array_push($data["imeautor"], $s);
                        
                    
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
                    if(count($temp))
                    {
                                          
                        foreach ($temp as $value)
                        {
                            $s .= $value->tag . ', ';                       
                        }                          
                    }
                    else 
                        $s = '-';
                    
                    if (strlen($s) > 1)
                        $s = substr($s, 0, -2);
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
		$niz_pocetak = array();
		$niz_zavrsetak = array();
                $niz_ide = array();
                $niz_alat = array();
                $niz_platforma = array();
		$niz_iznosrezultata = array();
		$niz_jedinicarezultata = array();
                $niz_ispitniprimjer = array();
		
		if (!empty($_POST["autor"]))
			$niz_autor = explode(",", $_POST["autor"]);
		if (!empty($_POST["naziv"]))
			$niz_naziv = explode(",", $_POST["naziv"]);	
		if (!empty($_POST["vrijemepocetka"]))
                        array_push ($niz_pocetak, $_POST["vrijemepocetka"]);
		if (!empty($_POST["vrijemezavrsetka"]))
			array_push($niz_zavrsetak, $_POST["vrijemezavrsetka"]);
		if (!empty($_POST["nazivide"]))
			$niz_ide = explode(",", $_POST["nazivide"]);
                if (!empty($_POST["nazivalat"]))
			$niz_alat = explode(",", $_POST["nazivalat"]);
                if (!empty($_POST["nazivplatforma"]))
			$niz_platforma = explode(",", $_POST["nazivplatforma"]);                
                if (!empty($_POST["iznosrezultata"]))
			$niz_iznosrezultata = explode(",", $_POST["iznosrezultata"]);	
		if (!empty($_POST["jedinicarez"]))
			$niz_jedinicarezultata = explode(",", $_POST["jedinicarez"]);
                if (!empty($_POST["ispitniprimjer"]))
			$niz_ispitniprimjer = explode(",", $_POST["ispitniprimjer"]);
			/* dohvaćanje podataka iz tablica */
		
                
                /* dohvaćanje podataka iz tablica */
                 
                $znanstvenieksperiment = new \model\DBZnanstveniEksperiment();
                $rezultat = new \model\DBRezultat();
                $ostvario = new \model\DBOstvario();
                $alat = new \model\DBAlat();
                $ostvaren = new \model\DBOstvaren;
                $platforma = new \model\DBPlatforma();
                $koristi = new \model\DBKoristi();
                $ide = new \model\DBIde();
                $uraden = new \model\DBUraden();               
                $autor = new \model\DBAutor();               
                $autoreksperimenta  = new \model\DBAutorEksperimenta();     
                $pripadaju = new \model\DBPripadaju();
                $parametar = new \model\DBParametar();
                $portfelj = new \model\DBPortfelj();
                
		//print_r($niz_pocetak);
                
                $eksperimenti = array();//tu čuvam id eksperimenata koji zadovoljavaju kriterije po kojima tražiš
                
                
                $i = 0;
                foreach ($niz_autor as $tmp) {                    
                    $eks_autor_tmp = $autoreksperimenta->select()->innerJoin("autor ON autor.idAutora = autoreksperimenta.idAutora"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = autoreksperimenta.idEksperimenta")->where(array("autor.prezime" => $tmp))->fetchAll();
                                        
                    if ($i == 0) {
                        foreach ($eks_autor_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_autor_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                }                 
                 
                $i = 0;
                foreach ($niz_naziv as $tmp) {
                    $eks_tmp = $znanstvenieksperiment->select()->where(array("znanstvenieksperiment.naziv" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                }  
                
                $i = 0;
                foreach ($niz_pocetak as $tmp) {
                    $eks_tmp = $znanstvenieksperiment->select()->where(array("znanstvenieksperiment.vrijemePocetka" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                }
                
                                
                $i = 0;
                foreach ($niz_zavrsetak as $tmp) {
                    $eks_tmp = $znanstvenieksperiment->select()->where(array("znanstvenieksperiment.vrijemeZavrsetka" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                } 
                
                $i = 0;
                foreach ($niz_ide as $tmp) {
                    $eks_ide_tmp = $uraden->select()->innerJoin("ide ON ide.idIDE = uraden.idIDE"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = uraden.idEksperimenta")->where(array("ide.skraceniNaziv" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_ide_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_ide_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                } 
                
                $i = 0;
                foreach ($niz_alat as $tmp) {
                    $eks_alat_tmp = $ostvaren->select()->innerJoin("alat ON alat.idAlata = ostvaren.idAlata"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = ostvaren.idEksperimenta")->where(array("alat.skraceniNaziv" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) && !count($niz_ide) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_alat_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_alat_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                }
                
                $i = 0;
                foreach ($niz_platforma as $tmp) {
                    $eks_platforma_tmp = $koristi->select()->innerJoin("platforma ON platforma.idPlatforme = koristi.idPlatforme"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = koristi.idEksperimenta")->where(array("platforma.skraceniNaziv" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) && !count($niz_ide) && !count($niz_alat) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_platforma_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_platforma_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                } 
                
                $i = 0;
                foreach ($niz_iznosrezultata as $tmp) {
                    $eks_rez_tmp = $ostvario->select()->innerJoin("rezultat ON rezultat.idRezultata = ostvario.idRezultata"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = ostvario.idEksperimenta")->where(array("rezultat.iznos" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) 
                            && !count($niz_ide) && !count($niz_alat) && !count($niz_platforma) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($rad_rez_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($rad_rez_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                } 
                
                $i = 0;
                foreach ($niz_jedinicarezultata as $tmp) {
                    $eks_rez_tmp = $ostvario->select()->innerJoin("rezultat ON rezultat.idRezultata = ostvario.idRezultata"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = ostvario.idEksperimenta")->where(array("rezultat.mjernaJedinica" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) 
                            && !count($niz_ide) && !count($niz_alat) && !count($niz_platforma) && !count($niz_iznosrezultata) && ($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi radove u niz radovi
                        foreach ($eks_rez_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_rez_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                }  
                
                $i = 0;
                foreach ($niz_ispitniprimjer as $tmp) {
                    $eks_ispitprimjer_tmp = $pripadaju->select()->innerJoin("parametar ON parametar.idParametra = pripadaju.idParametra"
                        )->innerJoin("znanstvenieksperiment ON znanstvenieksperiment.idEksperimenta = pripadaju.idEksperimenta")->where(array("rezultat.mjernaJedinica" => $tmp))->fetchAll();
                    
                    if (!count($niz_autor) && !count($niz_naziv) && !count($niz_pocetak) && !count($niz_zavrsetak) 
                            && !count($niz_ide) && !count($niz_alat) && !count($niz_platforma) && !count($niz_iznosrezultata) && !count($niz_jedinicarezultata) &&($i == 0)) { // ako nije ništa upisao u prošlom polju i prvi je unos onda unesi eksperimente
                        foreach ($eks_ispitprimjer_tmp as $value) 
                            array_push($eksperimenti, $value->idEksperimenta);  
                        $i++;
                    }
                    else {
                        $temp = array();
                        foreach ($eks_ispitprimjer_tmp as $value)
                            array_push($temp, $value->idEksperimenta);
                        
                        $eksperimenti = array_intersect($temp, $eksperimenti);      
                        
                    }
                } 
                
                /* zapiši podatke u niz" */
               $eksperimenti = array_unique($eksperimenti, SORT_REGULAR);
               
               
               $data  = array (
                    "id" => array(), 
                    "imeautor" => array(),                    
                    "naziv" => array(),
                    "pocetak" => array(),
                    "zavrsetak" => array(),
                    "ocjena" => array()                   
                    // ima još polje "interan" koje govori jel eksperiment interni ili ne
                ); 
                
                //echo "Eksperimenti : " ;print_r($eksperimenti); echo "<br>";
		
                foreach($eksperimenti as $value)
                {
                    //echo "<br> <br <br> <br>"; print_r($_SESSION['auth']);
                   
                    
                    $jeinteran = $znanstvenieksperiment->select()->where(array(
                        "idEksperimenta" => $value, 
                        "vidljivost" => "I"
                        ))->fetchAll();
                                       
                    if(count($jeinteran) && (!($portfelj->postojiZapis($_SESSION['auth'], $value, NULL)))) // to je inerni eksperiment nekog drugog korinika  
                    {
                        //echo "<br> <br> <br> <br> <br> TU sam";                        
                        
                        continue;         
                            
                    }
                    
                    $znanstvenieksperimentpom = new \model\DBZnanstveniEksperiment();
                    $znanstvenieksperimentpom->idEksperimenta = $value;

                    //echo "<br> <br> <br> <br> <br> TU sam"; print_r($eks);
                    array_push($data["ocjena"], $znanstvenieksperimentpom->prosjecnaOcjena());   
                        
                        
                   
                    
                   
                      /**************************/
                    
                    array_push($data["id"], $value); // dodaj id
                   
                    /******************************/ // dodaj naziv i datume
                    $eks = $znanstvenieksperiment->select()->where(array(
                      "idEksperimenta" => $value
                        ))->fetchAll();  
                    
                   // echo "Eksperimenti : " ;print_r($eks); echo "<br>";
                    
                    array_push($data["naziv"], $eks[0]->naziv);                     
                    array_push($data["pocetak"], $eks[0]->vrijemePocetka); 
                    array_push($data["zavrsetak"], $eks[0]->vrijemeZavrsetka); 
                    
                                     
                    /************************/ // dodaj autore
                    $eks_autor_tmp = $autoreksperimenta->select()->innerJoin("autor ON autor.idAutora = autoreksperimenta.idAutora")->where(array("autoreksperimenta.idEksperimenta" => $value))->fetchAll();
                    
                    $temp = array();
                    foreach ($eks_autor_tmp as $value2) 
                    {                           
                            $tmp = $autor->select()->where(array(
                              "idAutora" => $value2->idAutora
                            ))->fetchAll();
                            
                            $temp = array_unique(array_merge($temp,$tmp), SORT_REGULAR);           
                                
                    }    
                    
                    $s = '';  
                    if (count($temp))
                    {
                                              
                        foreach ($temp as $value3)
                        {
                            $s .= $value3->ime . ' ' .$value3->prezime . ', ';                           
                        }                                          
                    }
                    else
                    {
                        $s = '-';                        
                    }
                    
                    if (strlen($s) > 1)
                        $s = substr($s, 0, -2);
                    array_push($data["imeautor"], $s);
                        
                }
                    
                
                 //echo "Eksperimenti : " ;print_r($data["id"]); echo "<br>";
		
                
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
