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
                $this->errorMessage="Uspješno ste dodali znanstveni časopis!";
                break;
            case 3:
                $this->errorMessage="Uspješno ste dodali znanstveni skup!";
                break;
            case 4:
                $this->errorMessage="Uspješno ste dodali razvojno okruženje!";
                break;
            case 5:
                $this->errorMessage="Uspješno ste dodali javni alat!";
                break;
            case 6:
                $this->errorMessage="Uspješno ste dodali";
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
     
     public function displayDodavanjeZnanstvenogCasopisa() {
         if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         $error = null;
         switch (get("msg")) {
             case 1:
                $error = "Sva polja moraju biti popunjena!";
    
             case 2:
                 $error ="Postoji identičan časopis!";
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
     
     public function displayPregledZnanstvenihCasopisa(){
          // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $casopis = new \model\DBZnanstveniCasopis();
        $casopisi = $casopis->dohvatiZnanstveneCasopise();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeći znanstveni časopis!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisan znanstveni časopis!";
                break;
            case 4:
                $error = "Naziv je obavezan!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledZnanstvenihCasopisa(array(
                "casopisi" => $casopisi,
                "errorMessage" => $error
            )),
            "title" => "Pregled znanstvenih časopisa"
        ));
     }
     
     public function displayMijenjanjeBrisanjeZnanstvenogCasopisa() {
         if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Naziv je obavezan!";
                break;
            case 2:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            case 3:
                $error = "Nepostojeći znanstveni časopis!";
                break;
            default:
                break;
        }
        
        if(get("id") !== false) {
            $casopis = new \model\DBZnanstveniCasopis();
            try {
                $casopis->load(get("id"));
                echo new \view\Main(array(
                    "body" => new \view\MijenjanjeBrisanjeZnanstvenogCasopisa(array(
                        "casopis" => $casopis,
                        "errorMessage" => $error
                    )),
                    "title" => "Ažuriranje podataka o znanstvenome časopisu"
                ));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPregledZnanstvenihCasopisa"
                )) . "?msg=1");
            }            
        } else {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihCasopisa"
            )) . "?msg=1");
        }
    }
     
     
     public function updateZnanstveniCasopis() {
         if(post("checked") == true) {
            // znaci da trebam brisati casopis
            $casopis = new \model\DBZnanstveniCasopis();
            $pov = $casopis->brisiZnanstveniCasopis(post("id"));
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihCasopisa"
            )) . "?msg=3");
        } else {
            
            if(post("naziv") === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihCasopisa"
            )) . "?msg=4");
            }
            
             $casopis = new \model\DBZnanstveniCasopis();
            try {
                 $casopis->load(post("id"));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenihCasopisa"
                )) . "?msg=3");
            }
            
           
            
             $casopis->naziv = post("naziv");
            $casopis->godiste = post("godiste");
             $casopis->redniBroj = post("redniBroj");
             $casopis->adresa = post("adresa");
         
            
            $casopis->save();
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihCasopisa"
            )) . "?msg=2");
            
        }
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
    
    public function displayPregledZnanstvenihSkupova(){
          // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $skup = new \model\DBZnanstveniSkup();
        $skupovi = $skup->dohvatiZnanstveneSkupove();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeći znanstveni skup!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisan znanstveni skup!";
                break;
            case 4:
                $error = "Naziv je obavezan!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledZnanstvenihSkupova(array(
                "skupovi" => $skupovi,
                "errorMessage" => $error
            )),
            "title" => "Pregled znanstvenih skupova"
        ));
     }
     
     public function displayMijenjanjeBrisanjeZnanstvenogSkupa() {
          if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Naziv je obavezan!";
                break;
            case 2:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            case 3:
                $error = "Nepostojeći znanstveni časopis!";
                break;
            default:
                break;
        }
        
        if(get("id") !== false) {
            $skup = new \model\DBZnanstveniSkup();
            try {
                $skup->load(get("id"));
                echo new \view\Main(array(
                    "body" => new \view\MijenjanjeBrisanjeZnanstvenogSkupa(array(
                        "skup" => $skup,
                        "errorMessage" => $error
                    )),
                    "title" => "Ažuriranje podataka o znanstvenome skupu"
                ));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPregledZnanstvenihSkupova"
                )) . "?msg=1");
            }            
        } else {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihSkupova"
            )) . "?msg=1");
        }
    }
     
     public function updateZnanstveniSkup() {
         if(post("checked") == true) {
            // znaci da trebam brisati skup
            $skup = new \model\DBZnanstveniSkup();
            $pov = $skup->brisiZnanstveniSkup(post("id"));
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihSkupova"
            )) . "?msg=3");
        } else {
            
            if(post("naziv") === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihSkupova"
            )) . "?msg=4");
            }
            
             $skup = new \model\DBZnanstveniSkup();
            try {
                 $skup->load(post("id"));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenihSkupova"
                )) . "?msg=3");
            }
            
           
            
             $skup->naziv = post("naziv");
            $skup->mjesto = post("mjesto");
             $skup->drzava = post("drzava");
             $skup->danPocetka = post("danPocetka");
             $skup->danZavrsetka = post("danZavrsetka");
             $skup->adresa = post("adresa");
         
            
            $skup->save();
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledZnanstvenihSkupova"
            )) . "?msg=2");
            
        }
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
            "title" => "Dodavanje alata"
        ));
    }
    
     public function dodajJavniAlat(){
        if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         if(post("naziv") === false || post("skraceni")=== false ||
                 post("inacica")=== false  || post("cijena")=== false
                 || post("link") === false){
             preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlata"
            )) . "?msg=1");
          }
          
          $pattern = '/^[A-Za-z0-9]{1,}$/u';
           $pov = $this->test_pattern($pattern, post("skraceni"));
         if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlata"
            )) . "?msg=2");
        }
          
          
          $alat= new \model\DBAlat();
          
           if ($alat->loadSkraceniNaziv(post("skraceni")) == true){
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeJavnogAlata"
            )) . "?msg=3");
        }
        
        $alat->naziv=post("naziv");
        $alat->skraceniNaziv=post("skraceni");
        $alat->inacica=post("inacica");
        $alat->cijena=post("cijena");
        $alat->vidljivost="J";
        $alat->link=post("link");
        $alat->save();
        
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=5");
    }
    
     public function displayPregledJavnihAlata() {
             // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $alat = new \model\DBAlat();
        $alati = $alat->dohvatiJavneAlate();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeći javni alat!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisan javni alat!";
                break;
            case 4:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledJavnihAlata(array(
                "alati" => $alati,
                "errorMessage" => $error
            )),
            "title" => "Pregled javnih alata"
        ));
    }
    
     public function displayMijenjanjeBrisanjeJavnogAlata() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            case 2:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            case 3:
                $error = "Nepostojeći javni alat!";
                break;
            default:
                break;
        }
        
        if(get("id") !== false) {
            $alat = new \model\DBAlat();
            try {
                $alat->load(get("id"));
                echo new \view\Main(array(
                    "body" => new \view\MijenjanjeBrisanjeJavnogAlata(array(
                        "alat" => $alat,
                        "errorMessage" => $error
                    )),
                    "title" => "Ažuriranje podataka o javnom alatu"
                ));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPregledJavnihAlata"
                )) . "?msg=1");
            }            
        } else {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledJavnogAlata"
            )) . "?msg=1");
        }
    }
    
     public function updateJavniAlat() {
        if(post("checked") == true) {
            // znaci da trebam brisati javniAlat
            $alat = new \model\DBAlat();
            $pov = $alat->brisiJavniAlat(post("id"));
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledJavnihAlata"
            )) . "?msg=3");
        } else {
            
            if(post("naziv") === false || post("skraceniNaziv") === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledJavnihAlata"
            )) . "?msg=4");
            }
            
            $alat = new \model\DBalat();
            try {
                $alat->load(post("id"));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayAzuriranjeJavnihAlata"
                )) . "?msg=3");
            }
            
           
            
            $alat->naziv = post("naziv");
            $alat->skraceniNaziv = post("skraceniNaziv");
            $alat->inacica = post("inacica");
            $alat->cijena = post("cijena");
            $alat->vidljivost="J";
            $alat->link=post("link");
         
            
            $alat->save();
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledJavnihAlata"
            )) . "?msg=2");
            
        }
        
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
            "title" => "Dodavanje razvojnih okruženja"
        ));
    }
    
     public function dodajIDE(){
        if(!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
             preusmjeri(\route\Route::get('d1')->generate());
         }
         
         if(post("naziv") === false || post("skraceni")=== false ||
                 post("inacica")=== false  || post("cijena")=== false){
             preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeIDE"
            )) . "?msg=1");
          }
          
          $pattern = '/^[A-Za-z0-9]{1,}$/u';
           $pov = $this->test_pattern($pattern, post("skraceni"));
         if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeIDE"
            )) . "?msg=2");
        }
          
          
          $ide= new \model\DBIde();
          
           if ($ide->loadSkraceniNaziv(post("skraceni")) == true){
            preusmjeri(\route\Route::get('d3')->generate(array(
               "controller" => "ekspertnaOsobaCtl",
                "action" => "displayDodavanjeIDE"
            )) . "?msg=3");
        }
        
        $ide->naziv=post("naziv");
        $ide->skraceniNaziv=post("skraceni");
        $ide->inacica=post("inacica");
        $ide->cijena=post("cijena");
        $ide->vidljivost="J";
        $ide->save();
        
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "ekspertnaOsobaCtl",
        )) . "?msg=4");
    }
    
     public function displayPregledIDE(){
        
             // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $IDE = new \model\DBIde();
        $IDEi = $IDE->dohvatiIDE();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeći IDE!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisan IDE!";
                break;
            case 4:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledIDE(array(
                "IDEi" => $IDEi,
                "errorMessage" => $error
            )),
            "title" => "Pregled IDE"
        ));
         
     }
     
     public function displayMijenjanjeBrisanjeIDE(){
             // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            case 2:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            case 3:
                $error = "Nepostojeći IDE!";
                break;
            default:
                break;
        }
        
        if(get("id") !== false) {
            $IDE = new \model\DBIde();
            try {
                $IDE->load(get("id"));
                echo new \view\Main(array(
                    "body" => new \view\MijenjanjeBrisanjeIDE(array(
                        "IDE" => $IDE,
                        "errorMessage" => $error
                    )),
                    "title" => "Ažuriranje podataka o IDE-u"
                ));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPregledIDE"
                )) . "?msg=1");
            }            
        } else {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledIDE"
            )) . "?msg=1");
        }
    }
    
     public function updateIDE(){
         if(post("checked") == true) {
            // znaci da trebam brisati javniAlat
            $IDE = new \model\DBIde();
            $pov = $IDE->brisiIDE(post("id"));
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledIDE"
            )) . "?msg=3");
        } else {
            
            if(post("naziv") === false || post("skraceniNaziv") === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                "action" => "displayMijenjanjeBrisanjeIDE"
            )) . "?msg=1");
            }
            
            $IDE = new \model\DBIde();
            try {
                $IDE->load(post("id"));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeIDE"
                )) . "?msg=3");
            }
            
           
            
            $IDE->naziv = post("naziv");
            $IDE->skraceniNaziv = post("skraceniNaziv");
            $IDE->inacica = post("inacica");
            $IDE->cijena = post("cijena");
            $IDE->vidljivost="J";
            
         
            
            $IDE->save();
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ekspertnaOsobaCtl",
                "action" => "displayPregledIDE"
            )) . "?msg=2");
            
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
             "title" => "Dodavanje platformi"
         ));
     }
     
     public function displayPregledPlatformi(){
          // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $platforma = new \model\DBPlatforma();
        $platforme = $platforma->dohvatiPlatforme();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeća platforma!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisana platforma!";
                break;
            case 4:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledPlatformi(array(
                "platforme" => $platforme,
                "errorMessage" => $error
            )),
            "title" => "Pregled platformi"
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
     
     public function displayPregledSklopovlja(){
         
          // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'E') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $sklopovlje = new \model\DBSklopovlje();
        $sklopovlja = $sklopovlje->dohvatiSklopovlja();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeće sklopovlje!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisano sklopovlje!";
                break;
            case 4:
                $error = "Naziv i skraćeni naziv su obavezni!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledSklopovlja(array(
                "sklopovlja" => $sklopovlja,
                "errorMessage" => $error
            )),
            "title" => "Pregled sklopovlja"
        ));
         
     }

     
     
     

     
     
     
}
