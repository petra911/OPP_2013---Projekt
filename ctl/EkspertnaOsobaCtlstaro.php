<?php

namespace ctl;
use opp\controller\Controller;

class EkspertnaOsobaCtl implements Controller {
    public function displayDodavanjeRada() {
        // ispisujes View DodavanjeRada

             
         }
         
    
     /**
     * analogno gornjem napravi funckije i za Eksperiment, Javni Alat, IDE, Platforme, SKlopovlje i uređaje
     */
    
     public function dodajRad() {
         //provjeris podatke u obrascu (provjeri je li poslan pdf - ako je potrebno)
         // i dodas podatke u bazu - ako postoji pdf stavi ga na server u folder pdf
     }

     /**
     * analogno gornjem napravi funckije i za Eksperiment, Javni Alat, IDE, Platforme, SKlopovlje i uređaje
     */
    
    public function azurirajRad() {
        // korisnik ce u njemu nesto promijeniti i kad klikne na submit ti ce se naci u ovoj funckiji -> tu azuriras sadrzaj baze
        // ako ti je checkiran radio checkbox za brisanje trebas izbrisati rad;
    }
    
    /**
     * analogno gornjem napravi funckije i za Eksperiment, Javni Alat, IDE, Platforme, SKlopovlje i uređaje
     */
    
    public function displayAzuriranjeRada() {
        // prikazes postojeci rad (podatke o njemu unutar obrasca kojeg ces vec popuniti s podacima iz baze
        // dakle ovdje uz provjere (pogledaj recimo display u ostlim klasama) pozoves View koji ce ispisati taj obrazac
    }
     /**
     * analogno gornjem napravi funckije i za Eksperiment, Javni Alat, IDE, Platforme, SKlopovlje i uređaje
     */
    
     public function displayPrijedlozi() {
         // preusmjeri na pogled PrijedloziKorisnika 
     }
     
     public function sendReply() {
         // vraca odgovor korisniku
         // dakle zapisujes u bazu odgovor
         // i nakon toga brises prijdelog (jer si ga obradio)
     }
     
     public function generateReport() {
//         generirasIzvjesce ONAKO KAKO JE ASISTENT REKAO - POGLEDAJ PITANJA S KONZULTACIJA
//         mozes ga spremiti na server (recimo folder pdf) pod nekim stalnim imenom (tako da nakon sto se generira novi report samo stari prebrises
         // pazi mozes imati vise ekspertnih osoba => vise pdf-ova (u imenu im zapisi njihov id tako ces ih razlikovati)
     }
     
     public function displayReport() {
         // u suradnji s lukom (mozete preko View-a kojeg trebate napraviti)
     }
	 
	 public function displayDodavanjeJavnogAlataIde() { 
		 // ako nisi logiran bjezi odavde 
		 if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') { 
			preusmjeri(\route\Route::get('d1')->generate());
		 } 
		 $error = null; 
		 switch (get("msg")) { 
			case 1: 
				$error = "Sva polja moraju biti popunjena!"; 
				break; 
			case 2: 
				$error = "Skraćeni naziv sastoji se od alfanumeričkih znakova bez razmaka!"; 
				break; case 3: $error = "Skraćeni naziv već postoji!"; 
				break; 
			default: 
				break; 
			}
		$e = new \model\DBZnanstveniEksperiment();
		echo new \view\Main(array( "body" => new \view\DodavanjeJavnogAlataIde(array( 
			"errorMessage" => $error )), "title" => "Dodavanje Alata i Razvojnih Okruženja" )); 
	}
     
     public function displayDodavanjePlatformi() {
         
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                $error = "Sva polja moraju biti popunjena!";
                 break;
             case 2:
                $error = "Skraćeni naziv sastoji se od alfanumeričkih znakova bez razmaka!";
                 break;
             case 3:
                $error = "Skraćeni naziv već postoji!";
             case 4:
                $error = "Morate unijeti brojčanu vrijednost za cijenu!";
                 break;
             default:
                 break;
             
         }
         
         
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjePlatformi(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje Platformi"
         ));
     }
     
     private function test_pattern($pattern, $data) {
            if (false === is_string($data)) {
                    return false;
            } else {
                    return preg_match($pattern, $data)?true:false;
            }
    }
     
     public function dodajPlatformu() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $plat=new \model\DBPlatforma();
         $arr = $plat->getColumns();
         
         
         
        if( post("tip") === false ||post ("naziv")=== false  || post("skraceniNaziv")=== false 
                ||post("inacica")=== false  || post("link")=== false  || post("datasheet")=== false 
                || post("cijena")=== false ){
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=1");
        }
            
           
           $pattern = '/^[A-Za-z0-9]{1,}$/u';
           $pov = $this->test_pattern($pattern, post("skraceniNaziv"));
         if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=2");
        }
        
        if ($plat->postojiSkraceniNaziv(post("skraceniNaziv")) == true){
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=3");
        }
        
        $pattern1 = '/^[0-9]{1,}\.{0,1}[0-9]{0,}$/u';
        $pov1 = $this->test_pattern($pattern1, post("cijena"));
        if($pov1 === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=4");
        }
        
         
         
     
        $plat->tip = post("tip");
        $plat->naziv = post("naziv");
        $plat->skraceniNaziv = post("skraceniNaziv");
        $plat->inacica = post("naziv");
        $plat->link = post("naziv");
        $plat->datasheet = post("naziv");
        $plat->cijena = post("naziv");
         $plat->save();
         if($platforme->postojiSkraceniNaziv(post('sname'))){
              preusmjeri(\route\Route::get("d3")->generate(array(
                 "controller" => "ekspertnaOsobaCtl",
                 "action" => "displayDodavanjePlatformi"
             )) . "?msg=0");
         }
         
         
         
         preusmjeri(\route\Route::get('d1')->generate());
     }
     
     public function displayDodavanjeZnanstvenogCasopisa() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                 $error = "Moj ispis!";
                 break;
             case 2:
                 $error = "Zapis već postoji!";
                 break;
             default :
                 break;
             
         }
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjeZnanstvenogCasopisa(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje znanstvenog časopisa"
         ));
     }
     
     
     public function displayDodavanjeAlataIde() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                 $error = "Moj ispis!";
                 break;
             case 2:
                 $error = "Zapis već postoji!";
                 break;
             default :
                 break;
             
         }
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjeAlataIde(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje javnog alata"
         ));
     }
     
     
     
     public function displayDodavanjeUredjaja() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                 $error = "Moj ispis!";
                 break;
             case 2:
                 $error = "Zapis već postoji!";
                 break;
             default :
                 break;
             
         }
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjeUredjaja(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje uređaja"
         ));
     }
     
     public function displayDodavanjeSklopovlja() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                 $error = "Moj ispis!";
                 break;
             case 2:
                 $error = "Zapis već postoji!";
                 break;
             default :
                 break;
             
         }
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjeSklopovlja(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje sklopovlja"
         ));
     }
     
     public function displayDodavanjeZnanstvenogSkupa() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                 $error = "Moj ispis!";
                 break;
             case 2:
                 $error = "Zapis već postoji!";
                 break;
             default :
                 break;
             
         }
         
         echo new \view\Main(array(
             "body" => new \view\DodavanjeZnanstvenogSkupa(array(
                 "errorMessage" => $error
             )),
             "title" => "Dodavanje znanstvenog skupa"
         ));
     }
     

     
     
     
}
