<?php

namespace ctl;
use opp\controller\Controller;

class Korisnik implements Controller {
    private $errorMessage;
    
    /**
     * Korisnikov portfelj
     */
    public function display() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        switch(get("msg")) {
            case 1:
                $this->errorMessage = "Uspješno ste poslali zamolbu!";
                break;
            case 2:
                $this->errorMessage = "Morate unijeti tekst poruke!";
                break;
            case 3:
                $this->errorMessage = "Nepostojeći eksperiment!";
                break;
            case 4:
                $this->errorMessage = "Eksperiment nije javan!";
                break;
            case 5:
                $this->errorMessage = "Eksperiment je uspješno ocijenjen!";
                break;
            case 6:
                $this->errorMessage = "Dogodila se pogreška. Pokušajte ponovo!";
                break;
            case 7:
                $this->errorMessage = "Nepostojeći znanstveni rad!";
                break;
            case 8:
                $this->errorMessage = "Uspješno dodavanje u portfelj!";
                break;
            case 9:
                $this->errorMessage = "Uspješno brisanje iz portfelja!";
                break;
            default:
                break;
        }
        
        $zapisi = array();
        $portfelj = new \model\DBPortfelj();
        $por = $portfelj->dohvatiZapise($_SESSION['auth']);
        
        if(count($por)) {
            $i = 0;
            foreach($por as $p) {
                $zapisi[$i]['idZapisa'] = $p->idZapisa;
                $zapisi[$i]['idRada'] = $p->idRada;
                $zapisi[$i]['idEksperimenta'] = $p->idEksperimenta;
                
                $eksperiment = new \model\DBZnanstveniEksperiment();
                try {
                    $eksperiment->load($p->idEksperimenta);
                    $zapisi[$i]['nazivEksperimenta'] = $eksperiment->naziv;
                } catch (\opp\model\NotFoundException $e) {
                    
                }
                
                $rad = new \model\DBZnanstveniRad();
                try {
                    $rad->load($p->idRada);
                    $zapisi[$i]['nazivRada'] = $rad->naslov;
                } catch (\opp\model\NotFoundException $e) {
                    
                }                
                $i = $i + 1;                        
            }
        }
        
        echo new \view\Main(array(
            "body" => new \view\Portfelj(array(
                "errorMessage" => $this->errorMessage,
                "zapisi" => $zapisi
            )),
            "title" => "Portfelj"
        ));
    }
    
    public function ocijeni() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $ocjenjuje = new \model\DBOcjenjuje();
        $pov = $ocjenjuje->provjeraOcjene($_SESSION['auth'], post("id"));
        $ocjena = new \model\DBOcjena();
        
        if($pov == false) {
            $ocjena->oznaka = post("oznaka", NULL);
            $ocjena->ocjena = post("ocjena", NULL);
            $ocjena->save();
            
            $ocjenjuje->idKorisnika = $_SESSION['auth'];
            $ocjenjuje->idOcjene = $ocjena->getPrimaryKey();
            $ocjenjuje->idEksperimenta = post("id");
            $ocjenjuje->save();
            
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=5");
        } else {
            try {
                $ocjena->load($pov->idOcjene);
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
            }
            
            $ocjena->oznaka = post("oznaka", NULL);
            $ocjena->ocjena = post("ocjena", NULL);
            $ocjena->save();
            
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=5");
        }
    }
    
    public function displayOcjenjivanje() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(get("id") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik",
            )) . "?msg=3");
        }
        
        // znaci da imam id
        $eksperiment = new \model\DBZnanstveniEksperiment();
        try {
            $eksperiment->load(get("id"));
            if($eksperiment->vidljivost == 'I') {
                preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik",
            )) . "?msg=4");
            }
        } catch (\opp\model\NotFoundException $e) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik",
            )) . "?msg=3");
        }
        
        echo new \view\Main(array(
            "body" => new \view\Ocjenjivanje(array(
                "id" => get("id")
            )),
            "title" => "Ocjenjivanje Eksperimenata"
        ));
    }

        public function displayPromjenaModela() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        echo new \view\Main(array(
            "body" => new \view\PromjenaModela(),
            "title" => "Promjena Modela Plaćanja"
        ));
        
    }
    
    public function displayPoruke() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $poruka = new \model\DBPoruke();
        $zapisi = $poruka->dohvatiPoruke($_SESSION['auth']);
        $poruka->brisiPoruke($_SESSION['auth']);
        
        echo new \view\Main(array(
            "body" => new \view\Inbox(array(
                "poruke" => $zapisi)),
            "title" => "Inbox"
        ));
    }


    public function promijeniModel() {
        if(post("tekst") !== false) {
            $poruka = new \model\DBPoruke();
            $poruka->idPosiljatelja = post("id");
            $poruka->tekst = post("tekst");
            $poruka->idPrimatelja = -1;         // kod za ovlaštene osobe
            $poruka->save();
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=1");
        } else {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=2");
        }
    }
    
    public function logout() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        session_destroy();
        preusmjeri(\route\Route::get('d1')->generate());
    }
    
    public function dodajRadUPortfelj() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $korisnik = new \model\DBKorisnik();
        if(!$korisnik->userExists($_SESSION['auth'])) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
        }
        
        if(get("id") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=7");
        } else {
            $rad = new \model\DBZnanstveniRad();
            try {
                $rad->load(get("id"));
            }  catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=7");
            }
            
            $portfelj = new \model\DBPortfelj();
            if(!$portfelj->postojiZapis($_SESSION['auth'], null, get("id"))) {
                $portfelj->idKorisnika = $_SESSION['auth'];
                $portfelj->idEksperimenta = NULL;
                $portfelj->idRada = get("id");
                $portfelj->save();
            }
            
            preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=8");
        }
    }
    
    public function dodajEksperimentUPortfelj() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $korisnik = new \model\DBKorisnik();
        if(!$korisnik->userExists($_SESSION['auth'])) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
        }
        
        if(get("id") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=3");
        } else {
            $eksperiment = new \model\DBZnanstveniEksperiment();
            try {
                $eksperiment->load(get("id"));
            }  catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=3");
            }
            
            $portfelj = new \model\DBPortfelj();
            if(!$portfelj->postojiZapis($_SESSION['auth'], get("id"), NULL)) {
                $portfelj->idKorisnika = $_SESSION['auth'];
                $portfelj->idEksperimenta = get("id");
                $portfelj->idRada = NULL;
                $portfelj->save();
            }
            
            preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=8");
        }
    }
    
    public function brisiEksperiment() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(get("id") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=3");
        } else {
            $eksperiment = new \model\DBZnanstveniEksperiment();
            try {
                $eksperiment->load(get("id"));
                $portfelj = new \model\DBPortfelj();
                $pov = $portfelj->brisiZapis($_SESSION['auth'], get("id"), NULL);
               
                if(!$pov) {
                    preusmjeri(\route\Route::get('d2')->generate(array(
                        "controller" => "korisnik"
                    )) . "?msg=3");
                }
                
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=9");
            }  catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=3");
            }
        }
    }
    
    public function brisiRad() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(get("id") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=7");
        } else {
            $eksperiment = new \model\DBZnanstveniRad();
            try {
                $eksperiment->load(get("id"));
                $portfelj = new \model\DBPortfelj();
                $pov = $portfelj->brisiZapis($_SESSION['auth'], NULL, get("id"));
                
                if(!$pov) {
                    preusmjeri(\route\Route::get('d2')->generate(array(
                        "controller" => "korisnik"
                    )) . "?msg=7");
                }
                
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=9");
            }  catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=7");
            }
        }
    }
}
