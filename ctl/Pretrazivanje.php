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
    }
    
    public function pretraziEksperimente() {
        /**
         * ovdje trebas provjeriti je li ista uneseno ako je parsirati, te pretraziti bazu podataka a zatim dobivene rezultate prenijeti u view RezultatiPretrazivanjaEksperimenata
         * i prikazati ih -> konLukom
         */
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
    }
}
