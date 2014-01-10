<?php

namespace ctl;
use opp\controller\Controller;

class EkspertnaOsobaCtl implements Controller {
    
    public function display() {
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        switch(get("msg")){
            case 1:
                $this->errorMessage= "Uspješno ste dodali platformu!";
            case 2:
                $this->errorMessage="Uspješno ste dodali znanstveni časopis";
                break;
            case 3:
                $this->errorMessage="Uspješno ste dodali znanstveni skup!";
                break;
            case 4:
                $this->errorMessage="Uspješno ste dodali razvojno okruženje";
                break;
            default:
                break;
        }
        
        //kako izgleda homescreen za ekspertnu osobu?
        echo new \view\Main(array(
            "body" => new \view\Index(array(
                "errorMessage" => $this->errorMessage,
            )),
            "title" => "Index"
        ));
    }
    
    
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
     
      private function test_pattern($pattern, $data) {
            if (false === is_string($data)) {
                    return false;
            } else {
                    return preg_match($pattern, $data)?true:false;
            }
    }
     
     
     public function displayDodavanjePlatformi() {
         
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         
         
         $error = null;
         switch (get("msg")) {
             case 1:
                $error = "Sva obavezna polja moraju biti popunjena!";
                 break;
             case 2:
                $error = "Skraćeni naziv sastoji se od alfanumeričkih znakova bez razmaka!";
                 break;
             case 3:
                $error = "Skraćeni naziv već postoji!";
                 break;
             case 4:
                 $error = "Morate unijeti poveznicu ili pdf sa specifikacijama platforme";
                 break;
             case 5:
                 $error = "Uploadana datoteka nije u pdf obliku!";
                 break;
             case 6:
                $error = "Dopušteno slanje samo pdf datoteka!";
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

     public function dodajPlatformu() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         $plat=new \model\DBPlatforma();
         
              
        if( post("tip") === false ||post ("naziv")=== false  ||
                post("skraceniNaziv")=== false 
                ||post("inacica")=== false    
                || post("cijena")=== false){
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjePlatformi"
            )) . "?msg=1");
        }
              
              if (post("url") === false && files("tmp_name","datoteka") === false)
        {
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjePlatformi"
            )) . "?msg=4");
        }
              
           $pattern = '/^[A-Za-z0-9]{1,}$/u';
           $pov = $this->test_pattern($pattern, post("skraceniNaziv"));
         if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjePlatformi"
            )) . "?msg=2");
        }
        
        if ($plat->postojiSkraceniNaziv(post("skraceniNaziv")) == true){
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjePlatformi"
            )) . "?msg=3");
        }
        
        

        $plat->tip = post("tip");
        $plat->naziv = post("naziv");
        $plat->skraceniNaziv = post("skraceniNaziv");
        $plat->inacica = post("inacica");
        $plat->link = post("url");
        $plat->cijena = post("cijena");
        $plat->save();
        
        if(files("tmp_name", "datoteka") !== false) {
            
            if(function_exists('finfo_file')) {
                $finfo = \finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, files("tmp_name", "datoteka"));
            } else {
                $mime = \mime_content_type(files("tmp_name", "datoteka"));
            }
            if($mime != 'application/pdf') {
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjePlatformi"
            )) . "?msg=5");
            }
            //$prijedlog->lokacija = ;
            // snimam ga nakon ovoga u formatu idPrijedloga.pdf
            $destination = "./pdf/" . $plat->getPrimaryKey() . ".pdf";
             if(false === move_uploaded_file(files("tmp_name", "datoteka"), $destination)) {
                 preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                     "action" => "displayDodavanjePlatformi"
                )) . "?msg=6");
             }
             $plat->datasheet = $destination;
            
        }
        
        $plat->save();
        
        
        
         
         preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=1");
         
         
         
     }
    
     public function displayDodavanjeZnanstvenogCasopisa() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                $error = "Sva polja moraju biti popunjena!";
    
             case 2:
                 $error ="Postoji identican casopis!";
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
     
     public function dodajZnanstveniCasopis(){
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         $tmp=new \model\DBZnanstveniCasopis;
         
         if(post("name")===false || post("adress")===false || post("godiste")===false || post("rbroj")===false){
              preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeZnanstvenogCasopisa"
            )) . "?msg=1");
         }
         
        if($tmp->postojiIdenticanCasopis( post("name"),post("godiste"),post("rbroj"),post("adress"))){
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeZnanstvenogCasopisa"
            )) . "?msg=2");
        }
         
        
        $tmp->naziv = post("name");
        $tmp->godiste=post("godiste");
        $tmp->redniBroj=post("rbroj");
        $tmp->adresa=post("adress");
        $tmp->save();
        
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=2");
        
         
         
         
     }
     
     public function displayDodavanjeZnanstvenogSkupa() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                $error = "Sva polja moraju biti popunjena!";
                 break;
             case 2:
                 $error = "Neodgovarajući format vremena!";
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
     
     public function dodajZnanstveniSkup(){
        if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         if(post("naziv") === false || post("mjesto")=== false ||
                 post("drzava")=== false  || post("adresa")=== false){
             preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeZnanstvenogSkupa"
            )) . "?msg=1");
          }
          
          // provjera vremena:
            $pattern = '/^(0[0-9]|[1-2][0-9]|3[01])\.(0[0-9]|1[0-2])\.([0-9]{4})\./';
            $vrijeme1 = post("vrijemePocetka");
            $vrijeme2 = post("vrijemeZavrsetka");
            
            if($this->test_pattern($pattern, $vrijeme1) === false || $this->test_pattern($pattern, $vrijeme2) === false) {
                 preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeZnanstvenogSkupa"
            )) . "?msg=2");
            }
            
         $tmp=new \model\DBZnanstveniSkup;
         $tmp->naziv=post("naziv");
         $tmp->mjesto=post("mjesto");
         $tmp->drzava=post("drzava");
         $tmp->danPocetka=date("Y-m-d", strtotime(post("vrijemePocetka")));
         $tmp->danZavrsetka=date("Y-m-d", strtotime(post("vrijemeZavrsetka")));
         $tmp->adresa=post("adresa");
         $tmp->save();
          
          preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=3");
         
        
        
        
        
    }
     
     public function displayDodavanjeJavnogAlata() {
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
                break;
            case 3:
                $error = "Skraćeni naziv već postoji!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\DodavanjeJavnogAlata(array(
                "errorMessage" => $error
            )),
            "title" => "Dodavanje Alata"
        ));
    }
    
    public function displayDodavanjeIDE() {
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
                break;
            case 3:
                $error = "Skraćeni naziv već postoji!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\DodavanjeIDE(array(
                "errorMessage" => $error
            )),
            "title" => "Dodavanje Razvojnih Okruženja"
        ));
    }
    
    
    public function dodajJavniAlatIde(){
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(post("naziv") === false || post("skraceni") === false || post("inacica") === false || post("cijena") === false ) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlataIde"
            )) . "?msg=1");
        }
        
        $pattern = '/^[A-Za-z0-9]{1,}$/u';
        $pov = $this->test_pattern($pattern, post("skraceni"));
        if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlataIde"
            )) . "?msg=2");
        }
        
        if(post("checked") == true) {
            // znaci da dodajem alat
            $alat = new \model\DBAlat();
            if($alat->loadSkraceniNaziv(post("skraceni")) == true){
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlataIde"
            )) . "?msg=3");
            }
            else {
                $alat->naziv = post("naziv");
                $alat->skraceniNaziv = post("skraceni");
                $alat->inacica = post("inacica");
                $alat->cijena = post("cijena");
                $alat->vidljivost = 'J';
                $alat->link = NULL;
                $alat->save();
                preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=3");
            }
       } else {
            // dodajem Ide
            // znaci da dodajem alat
            $ide = new \model\DBIde();
            if($ide->loadSkraceniNaziv(post("skraceni")) == true){
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlataIde"
            )) . "?msg=3");
            }
            else {
                $ide->naziv = post("naziv");
                $ide->skraceniNaziv = post("skraceni");
                $ide->inacica = post("inacica");
                $ide->cijena = post("cijena");
                $ide->vidljivost = 'J';
                $ide->save();preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=4");
            }
       }
            
           
        
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
     
     
     

     
     
     
}
