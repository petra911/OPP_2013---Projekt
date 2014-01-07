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
     
     public function displayDodavanjePlatformi() {
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
         
         if(post('xd') === false) {
             preusmjeri(\route\Route::get('d3')->generate(array(
                 "controller" => "ekspertnaOsobaCtl",
                 "action" => "displayDodavanjePlatformi"
             )) . "?msg=1");
         }
         
         
         $platforme = new \model\DBPlatforma();
         $platforme->skraceniNaziv = post('xd');
         if(!$platforme->postojiSkraceniNaziv(post("xd"))) {
             preusmjeri(\route\Route::get("d3")->generate(array(
                 "controller" => "ekspertnaOsobaCtl",
                 "action" => "displayDodavanjePlatformi"
             )) . "?msg=2");
         }
         $platforme->save();
         
         preusmjeri(\route\Route::get('d1')->generate());
     }
}
