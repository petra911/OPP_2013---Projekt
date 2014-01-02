<?php

namespace ctl;
use opp\controller\Controller;

class OvlastenaOsobaCtl implements Controller {
    private $errorMessage;
    
    public function validate() {
        $id = get('id');
        $korisnik = new \model\DBKorisnik();
        $korisnik->load($id);
        $korisnik->validnost = 1;
        $korisnik->save();
        preusmjeri(\route\Route::get('d1')->generate());
    }

    public function displayRegistrations() {
        $korisnik = new \model\DBKorisnik();
        $zahtjevi = $korisnik->getValidationRequests();
        
        echo new \view\Main(array(
            "body" => new \view\Validation(array(
                "list" => $zahtjevi
            )),
            "title" => "Validacija Korisničkih Računa"
        ));
    }
    
    public function displayPregledKorisnika() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'O') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $korisnik = new \model\DBKorisnik();
        $korisnici = $korisnik->dohvatiRegistriraneKorisnike();
        
        $error = null;
        switch(get("msg")) {
            case 1:
                $error = "Nepostojeći korisnik!";
                break;
            case 2:
                $error = "Uspješno ažurirani podaci!";
                break;
            case 3:
                $error = "Uspješno obrisan korisnik!";
                break;
            case 4:
                $error = "Korisničko ime i mail su obavezni!";
                break;
            case 5:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\PregledKorisnika(array(
                "korisnici" => $korisnici,
                "errorMessage" => $error
            )),
            "title" => "Pregled Registriranih Korisnika"
        ));
    }
    
    public function displayAzuriranjeKorisnika() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'O') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Korisničko ime i mail su obavezni!";
                break;
            case 2:
                $error = "Pogrešno ispunjen obrazac!";
                break;
            case 3:
                $error = "Nepostojeći korisnik!";
                break;
            default:
                break;
        }
        
        if(get("id") !== false) {
            $korisnik = new \model\DBKorisnik();
            try {
                $korisnik->load(get("id"));
                echo new \view\Main(array(
                    "body" => new \view\AzuriranjeKorisnika(array(
                        "korisnik" => $korisnik,
                        "errorMessage" => $error
                    )),
                    "title" => "Ažuriranje Podataka o Korisniku"
                ));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayPregledKorisnika"
                )) . "?msg=1");
            }            
        } else {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayPregledKorisnika"
            )) . "?msg=1");
        }
    }
    
    public function updateUser() {
        if(post("checked") == true) {
            // znaci da trebam brisati korisnika
            $korisnik = new \model\DBKorisnik();
            $pov = $korisnik->brisiKorisnika(post("id"));
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayPregledKorisnika"
            )) . "?msg=3");
        } else {
            if(post("username") === false || post("mail") === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayPregledKorisnika"
                )) . "?msg=4");
            }
            
            $korisnik = new \model\DBKorisnik();
            try {
                $korisnik->load(post("id"));
            } catch (\opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayAzuriranjeKorisnika"
                )) . "?msg=3");
            }
            
            $p = post("datum", "0000-00-00");
            $datum = substr($p, 8, 2) . "-" . substr($p, 5, 2) . "-" . substr($p, 0, 4);
            if($datum == "00-00-0000") $datum = null;
            $validacija = new \model\RegisterFormModel(post("username"), post("pass", "lozinka"), $datum==null ? "02-12-1992" : $datum, post("ime", "Ime"), post("prez", "Prezime"), post("mail"));
            $pov = $validacija->validate();
            if($pov !== true) {
                 preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayPregledKorisnika"
                )) . "?msg=5");
            }
            
            $korisnik->username = post("username");
            $korisnik->datumRod = post("datum", "0000-00-00");
            $korisnik->ime = post("ime", null);
            $korisnik->prezime = post("prez", null);
            if(post("pass") !== false) {
                $korisnik->password = $korisnik->kriptPass(post("pass"));
            }
            $korisnik->mail = post("mail");
            
            // provjera vrste
            switch(strtoupper(post("vrsta"))) {
                case 'K':
                    $korisnik->vrsta = 'K';
                    break;
                case 'O':
                    $korisnik->vrsta = 'O';
                    break;
                case 'E':
                    $korisnik->vrsta = 'E';
                    break;
                default:
                    $korisnik->vrsta = 'K';
                    break;
            }
            
            //provjera validnosti
            switch(post("validnost")) {
                case 0:
                    $korisnik->validnost = 0;
                    break;
                case 1:
                    $korisnik->validnost = 1;
                    break;
                default:
                    preusmjeri(\route\Route::get('d3')->generate(array(
                        "controller" => "ovlastenaOsobaCtl",
                        "action" => "displayPregledKorisnika"
                    )) . "?msg=5");
                    break;
            }
            
            // provjera roka
            if(post("rok") === false) {
                $korisnik->rok = NULL;
            } else {
                $izraz = post("rok");
                if(strpos($izraz, "datum") !== false) {
                    if(strlen($izraz) == 5) {
                        preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
                    }
                    $dan = substr($izraz, 5);
                    if($dan < 1 || $dan > 28) {
                        preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
                    } else {
                        $korisnik->rokUplate = $izraz;
                    }
                } else if(strpos($izraz, "pon") !== false ||
                                strpos($izraz, "uto") !== false ||
                                strpos($izraz, "sri") !== false ||
                                strpos($izraz, "cet") !== false ||
                                strpos($izraz, "pet") !== false ||
                                strpos($izraz, "sub") !== false ||
                                strpos($izraz, "ned") !== false
                                ) {
                    if(strlen($izraz) == 3) {
                         preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
                    }
                    $broj = substr($izraz, 3);
                    if($broj < 1 || $broj > 4) {
                         preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
                    }
                    $korisnik->rokUplate = $izraz;
                } else {
                     preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
                }
            }
            
            // provjera iznosa
            $korisnik->uplata = post("iznos", null);
            $pattern = '/^[0-9]{1,}\.{0,1}[0-9]{0,}$/u';
            $pov1 = $this->test_pattern($pattern, $korisnik->uplata);
            if($korisnik->uplata !== null && $pov1 === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "ovlastenaOsobaCtl",
                            "action" => "displayPregledKorisnika"
                        )) . "?msg=5");
            }
            
            $korisnik->save();
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayPregledKorisnika"
            )) . "?msg=2");
            
        }
        
    }

    public function displayZahtjeviZaPromjenom() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $poruka = new \model\DBPoruke();
        $zapisi = $poruka->dohvatiPoruke(-1);
        
        $polje = array();
        $korisnik = new \model\DBKorisnik();
        $i = 0;
        if(count($zapisi)) {
            foreach ($zapisi as $v) {
                $korisnik->load($v->idPosiljatelja);
                $polje[$i]['posiljatelj'] = $korisnik->username;
                $polje[$i]['tekst'] = $v->tekst;
                $polje[$i]['id'] = $v->idPosiljatelja;
                $i = $i + 1;
            }
        }
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Poruka je uspješno poslana!";
                break;
            case 2:
                $error = "Model plaćanja uspješno promijenjen!";
                break;
            case 3:
                $error = "Neispravan datum!";
                break;
            case 4:
                $error = "Neispravan dan!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\ZahtjeviZaPromjenom(array(
                "zahtjevi" => $polje,
                "errorMessage" => $error
            )),
            "title" => "Zahtjevi za Promjenom Modela Plaćanja"
        ));
    }
    
    public function displayObradiZahtjev() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(get("id") !== false) {
            $poruka = new \model\DBPoruke();
            $p = $poruka->dohvatiPoruku(get('id'), -1);
            if($p === false) {
                preusmjeri(\route\Route::get('d1')->generate());
            }
            
            echo new \view\Main(array(
                "body" => new \view\ObradaZahtjeva(array(
                    "id" => get("id"),
                    "zahtjev" => $p
                )),
                "title" => "Obrada Zahtjeva"
            ));
        } else {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
    }
    
    public function obradiZahtjev() {
        if(post("datum") === false && post("dan") === false && post("tekst") === false) {
            preusmjeri(\route\Route::get('d1')->generate());
        } else if (post("datum") === false && post("dan") === false && post("tekst") !== false) {
            // samo posalji poruku bez mijenjanja modela plaćanja
            $poruka = new \model\DBPoruke;
            $poruka->idPosiljatelja = -1;
            $poruka->idPrimatelja = post("id");
            $poruka->tekst = post("tekst");
            $poruka->save();
            
            $poruka->brisiPoruku(post("id"), -1);
            
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayZahtjeviZaPromjenom"
            )) . "?msg=1");
        } else if (post("datum") !== false) {
            $datum = post("datum");
            if(false === strpos($datum, "datum") || strlen($datum) == 5) {
                 preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "?msg=3");
            }
            $dan = substr($datum, 5);
            if($dan > 28 || $dan < 1) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "?msg=3");
            }
            
            $korisnik = new \model\DBKorisnik();
            $korisnik->load(post("id"));
            $korisnik->rokUplate = $datum;
            $korisnik->save();
            
            // salji odgovor
            $poruka = new \model\DBPoruke;
            $poruka->idPosiljatelja = -1;
            $poruka->idPrimatelja = post("id");
            $poruka->tekst = post("tekst", null);
            if($poruka->tekst !== null)
            $poruka->save();
            
            $poruka->brisiPoruku(post("id"), -1);
            
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayZahtjeviZaPromjenom"
            )) . "?msg=2");
        } else if (post("dan") !== false) {
            $dan = post("dan");
            if(false === strpos($dan, "pon") ||
                    false === strpos($dan, "uto") ||
                    false === strpos($dan, "sri") ||
                    false === strpos($dan, "cet") ||
                    false === strpos($dan, "pet") ||
                    false === strpos($dan, "sub") ||
                    false === strpos($dan, "ned") || strlen($dan) == 3) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "?msg=4");
            }
            $tjedan = substr($dan, 3);
            if($tjedan < 1 || $tjedan > 4) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "?msg=4");
            }
            
            $korisnik = new \model\DBKorisnik();
            $korisnik->load(post("id"));
            $korisnik->rokUplate = $dan;
            $korisnik->save();
            
            // salji odgovor
            $poruka = new \model\DBPoruke;
            $poruka->idPosiljatelja = -1;
            $poruka->idPrimatelja = post("id");
            $poruka->tekst = post("tekst", null);
            if($poruka->tekst !== null)
            $poruka->save();
            
            $poruka->brisiPoruku(post("id"), -1);
            
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayZahtjeviZaPromjenom"
            )) . "?msg=2");
        } else {
            preusmjeri(\route\Route::get('d1')->generate());
        }
    }

    public function displayActions() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $zapisi = array();
        $akcija = new \model\DBAkcijaSustava();
        $a = $akcija->select()->fetchAll();
        $korisnik = new \model\DBKorisnik();
        $i = 0;
        foreach($a as $v) {
            $zapisi[$i]['vrijeme'] = $v->vrijeme;
            $zapisi[$i]['opis'] = $v->opisAkcije;
            $korisnik->load($v->idKorisnika);
            $zapisi[$i]['korisnik'] = $korisnik->username;
            $i = $i + 1;
        }
        echo new \view\Main(array(
            "body" => new \view\Akcije(array(
                "zapisi" => $zapisi
            )),
            "title" => "Akcije Korisnika"
        ));
    }


    public function displayUcitavanjeKonfiguracije() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        switch(get("msg")) {
            case 1:
                $this->errorMessage = "Morate odabrati datoteku!";
                break;
            case 2:
                $this->errorMessage = "Dozvoljene su samo tekstualne datoteke!";
                break;
            case 3:
                $this->errorMessage = "Neispravan format datoteke!";
                break;
            case 4:
                $this->errorMessage = "Uspješno učitavanje konfiguracije!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\UcitavanjeKonfiguracije(array(
                "errorMessage" => $this->errorMessage
            )),
            "title" => "Učitavanje Konfiguracije"
        ));
    }
    
    private function test_pattern($pattern, $data) {
            if (false === is_string($data)) {
                    return false;
            } else {
                    return preg_match($pattern, $data)?true:false;
            }
    }
    
    public function loadConfiguration() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if (files('name', 'datoteka') === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=1");
        }
        
        if(files('type', 'datoteka') != 'text/plain') {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=2");
        }
        
        $handle = fopen(files('tmp_name', 'datoteka'), "r");
        $prviRed = fscanf($handle, "%s %s %f %s");
        $drugiRed = fscanf($handle, '%s %s %s %s %s');
        fclose($handle);
        
        foreach($prviRed as $v) {
            if(!isset($v)) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=3");
            }
        }
        if($prviRed[0] != "Mjesečna" || $prviRed[1] != "naknada" || $prviRed[3] != "kn") {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=3");
        }
        
        foreach($drugiRed as $v) {
            if(!isset($v)) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=3");
            }
        }
        
        if($drugiRed[0] != "Rok" || $drugiRed[1] != "plaćanja" || $drugiRed[2] != "u" || $drugiRed[3] != "mjesecu") {
             preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=3");
        }

       $konfiguracija = new \model\DBKonfiguracija();
       $konfiguracija->loadOldConfiguration();
       $stara = null;
       if($konfiguracija->id == 1) {
           $stara = $konfiguracija->iznos;
       }
       $konfiguracija->iznos = $prviRed[2];
       $ind = strpos($drugiRed[4], "datum");
       if(false !== $ind){
           $konfiguracija->datum = substr($drugiRed[4], 6);
           $konfiguracija->datum = substr($konfiguracija->datum, 0, -1);
           $konfiguracija->dan = null;
       }
       else {
           $konfiguracija->datum = null;
           $konfiguracija->dan = substr($drugiRed[4], 1);
           $kofiguracija->dan = substr($drugiRed[4], 0, -1);
       }
       $konfiguracija->insertNewConfiguration();
       
       $korisnik = new \model\DBKorisnik();
       $korisnik->loadConfiguration($konfiguracija->iznos, $stara);
       
       preusmjeri(\route\Route::get('d3')->generate(array(
           "controller" => "ovlastenaOsobaCtl",
           "action" => "displayUcitavanjeKonfiguracije"
            )) . "?msg=4");
    }
    
    public function ponistiNeplatise() {
        $konfiguracija = new \model\DBKonfiguracija();
        $konfiguracija->loadOldConfiguration();
        $korisnik = new \model\DBKorisnik();
        
        
        if ($konfiguracija->datum != null) {
            if(date('j') > $konfiguracija->datum) {
                $korisnik->deaktivirajNeplatise();
            }
        } else {
            $dan = date('w');
            if ($dan == 0) $dan = 7;
            switch (substr($konfiguracija->dan, 0, 3)) {
                case 'pon':
                    $d = 1;
                    break;
                case 'uto':
                    $d = 2;
                    break;
                case 'sri':
                    $d = 3;
                    break;
                case 'cet':
                    $d = 4;
                    break;
                case 'pet':
                    $d = 5;
                    break;
                case 'sub':
                    $d = 6;
                    break;
                case 'ned':
                    $d = 7;
                    break;
                default:
                    break;
            }
            
            $t = substr($konfiguracija->dan,3, 1);
            $dani = date('j');
            $tjedan = floor($dani / 4) + 1;
            if($tjedan >= $t && $dan > $d) {
                $korisnik->deaktivirajNeplatise();
            }
        }
        
        $pov = $korisnik->select()->fetchAll();
        if(count($pov)) {
            foreach ($pov as $v) {
                if($v->rokUplate != NULL) {
                    $izraz = $v->rokUplate;
                    if(strpos($izraz, "datum") !== false) {
                        $dan = substr($izraz, 5);
                        if(date('j') > $dan && $v->vrsta == 'K') {
                            $v->rokUplate = NULL;
                            $v->validnost = 0;
                            $v->save();
                        }
                    }else if(false !== strpos($izraz, "pon") ||
                                    false !== strpos($izraz, "uto") ||
                                    false !== strpos($izraz, "sri") ||
                                    false !== strpos($izraz, "cet") ||
                                    false !== strpos($izraz, "pet") ||
                                    false !== strpos($izraz, "sub") ||
                                    false !== strpos($izraz, "ned")) {
                            $dan = date('w');
                            if ($dan == 0) $dan = 7;
                            switch (substr($izraz, 0, 3)) {
                                case 'pon':
                                    $d = 1;
                                    break;
                                case 'uto':
                                    $d = 2;
                                    break;
                                case 'sri':
                                    $d = 3;
                                    break;
                                case 'cet':
                                    $d = 4;
                                    break;
                                case 'pet':
                                    $d = 5;
                                    break;
                                case 'sub':
                                    $d = 6;
                                    break;
                                case 'ned':
                                    $d = 7;
                                    break;
                                default:
                                    break;
                            }
                            $t = substr($izraz,3, 1);
                            $dani = date('j');
                            $tjedan = floor($dani / 4) + 1;
                            if($tjedan >= $t && $dan > $d && $v->vrsta == 'K') {
                                $v->rokUplate = NULL;
                                $v->validnost = 0;
                                $v->save();
                            }
                        }
                    }
                }
            }
        
        preusmjeri(\route\Route::get('d1')->generate());
    }
}