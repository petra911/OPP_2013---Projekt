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
            case 10:
                $this->errorMessage = "Morate odabrati pdf file ili postaviti link na znanstveni rad!";
                break;
            case 11:
                $this->errorMessage = "Morate unijeti ili poruku ekspertnoj osobi ili odabrati časopis/rad!";
                break;
            case 12:
                $this->errorMessage = "Prijedlog uspješno poslan!";
                break;
            case 13:
                $this->errorMessage = "Dopušteno slanje samo pdf datoteka!";
                break;
            case 14:
                $this->errorMessage = "Uspješno dodavanje!";
                break;
            case 15:
                $this->errorMessage = "Uspješno povezivanje već postojećeg alata/razvojnog okruženja!";
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
    
    public function displayDodavanjeVlastitogEksperimenta() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $skup = new \model\DBZnanstveniSkup();
        $p = $skup->select()->fetchAll();
        
        $error = null;
        switch (get("msg")) {
            case 1:
                $error = "Neispravno popunjen obrazac!";
                break;
            case 2:
                $error = "Dozvoljene su samo tekstualne datoteke!";
                break;
            case 3:
                $error = "Neodgovarajući format vremena!";
                break;
            case 4:
                $error = "Neodgovarajući format parametara!";
                break;
            case 5:
                $error = "Neodgovarajući format rezultata!";
                break;
            case 6:
                $error = "Neodgovarajući format datoteke!";
                break;
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\DodavanjeVlastitogEksperimenta(array(
                "errorMessage" => $error,
                "skupovi" => $p
            )),
            "title" => "Dodavanje Vlastitog Eksperimenta"
        ));
    }
    
    public function  dodavanjeVlastitogEksperimenta() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if((post("naziv") === false || post("vrijemePocetka") === false || post("vrijemeZavrsetka") === false || post("parametri")=== false || post("rezultati") === false) && files("tmp_name", "datoteka") === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeVlastitogEksperimenta"
            )) . "?msg=1");
        }
        
        // ako je poslana datoteka gledam samo nju
        if(files("tmp_name", "datoteka") !== false) {
            if(function_exists('finfo_file')) {
                $finfo = \finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, files("tmp_name", "datoteka"));
            } else {
                $mime = \mime_content_type(files("tmp_name", "datoteka"));
            }
            if($mime != 'text/plain') {
                preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeVlastitogEksperimenta"
            )) . "?msg=2");
            }
            
            $autori = array();
            $a = 0;
            $parametri = array();
            $p = 0;
            $rezultati = array();
            $r = 0;
            $tools = array();
            $ides = array();
            $platforms = array();
            $start = null;
            $end = null;
            $naslov = null;
            
            $handle = fopen(files("tmp_name", "datoteka"), "rt");
            $naslov = fgets($handle);
            $naslov = substr($naslov, 0, strlen($naslov) - 1);
            if($naslov === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                    "controller" => "korisnik",
                    "action" => "displayDodavanjeVlastitogEksperimenta"
                )) . "?msg=6");
            }
            
            while(($niz = fgets($handle)) !== FALSE) {
                $niz = substr($niz, 0, strlen($niz) - 1);
                $i = strpos($niz, " ");
                $identifikator = substr($niz, 0, $i);
                
                switch ($identifikator) {
                    case "Author":
                        $pattern = '/^(Author) [A-ZČĆŽŠĐ][a-zčćžšđ]+ ([A-ZČĆŽŠĐ]\. ){0,1}[A-ZČĆŽŠĐ][a-zčćžšđ]+$/u';
                        if($this->test_pattern($pattern, $niz) === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $s1 = strpos($niz, " ");
                        $s2 = strpos($niz, " ", $s1 + 1);
                        $s3 = strpos($niz, " ", $s2 + 1);
                        if($s3 === false) {
                            $autori[$a]["ime"] = substr($niz, $s1 + 1, $s2 - $s1 - 1);
                            $autori[$a]["prezime"] = substr($niz, $s2 + 1);
                        } else {
                            $autori[$a]["ime"] = substr($niz, $s1 + 1, $s2 - $s1 - 1);
                            $autori[$a]["prezime"] = substr($niz, $s3 + 1);
                        }
                        $a = $a + 1;
                        break;
                    case "Start":
                        $pattern = '/^Start (0[0-9]|[1-2][0-9]|3[01])\.(0[0-9]|1[0-2])\.([0-9]{4})\. ([01][0-9]|2[0-4]):[0-5][0-9]$/';
                        if($this->test_pattern($pattern, $niz) === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $start = date("Y-m-d H:i:s", strtotime($niz));
                        break;
                    case "End":
                        $pattern = '/^End (0[0-9]|[1-2][0-9]|3[01])\.(0[0-9]|1[0-2])\.([0-9]{4})\. ([01][0-9]|2[0-4]):[0-5][0-9]$/';
                        if($this->test_pattern($pattern, $niz) === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $end = date("Y-m-d H:i:s", strtotime($niz));
                        break;
                    case "Tool":
                        $skraceniNaziv = substr($niz, $i + 1);
                        $alat = new \model\DBAlat();
                        $idAlata = $alat->dohvatiId($skraceniNaziv);
                        if($idAlata === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $tools[$idAlata] = $idAlata;
                        break;
                    case "IDE":
                        $skraceniNaziv = substr($niz, $i + 1);
                        $alat = new \model\DBIde();
                        $idAlata = $alat->dohvatiId($skraceniNaziv);
                        if($idAlata === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $ides[$idAlata] = $idAlata;
                        break;
                    case "Platform":
                        $skraceniNaziv = substr($niz, $i + 1);
                        $platforma = new \model\DBPlatforma();
                        $pov = $platforma->select()->where(array(
                            "skraceniNaziv" => $skraceniNaziv
                        ))->fetchAll();

                        if(count($pov)) {
                            $idPlatforme = $pov[0]->idPlatforme;
                            $platforms[$idPlatforme] = $idPlatforme;
                        } else {
                             preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        break;
                    case "Parameter":
                        $j = strpos($niz, " ", $i + 1);
                        if($j === FALSE) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $naziv = substr($niz, $i + 1, $j - $i - 1);
                        $ispitniSlucaj = substr($niz, $j + 1);
                        $pattern = '/^[A-Za-z0-9]{1,}$/u';
                        if($this->test_pattern($pattern, $naziv) === false || $this->test_pattern($pattern, $ispitniSlucaj) === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        
                        $parametri[$p]["ispitniSlucaj"] = $ispitniSlucaj;
                        $parametri[$p]["naziv"] = $naziv;
                        $p = $p + 1;
                        break;
                    case "Value":
                        $j = strpos($niz, " ", $i + 1);
                        $k = strpos($niz, " ", $j + 1);
                        if($j === FALSE) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $naziv = substr($niz, $i + 1, $j - $i - 1);
                        if($k !== false) {
                            $iznos = substr($niz, $j + 1, $k - $j -1);
                            $mjernaJedinica = substr($niz, $k + 1);
                            $pat = '/^[A-Za-z]{1,10}$/u';
                            if($this->test_pattern($pat, $mjernaJedinica) === false) {
                                preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                            }
                        } else {
                            $iznos = substr($niz, $j + 1);
                        }
                        $pattern = '/^[A-Za-z0-9]{1,}$/u';
                        $pattern2 = '/^[0-9]{1,}\.{0,1}[0-9]*$/u';
                        if($this->test_pattern($pattern, $naziv) === false ||$this->test_pattern($pattern2, $iznos) === false) {
                            preusmjeri(\route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayDodavanjeVlastitogEksperimenta"
                            )) . "?msg=6");
                        }
                        $rezultati[$r]["iznos"] = $iznos;
                        $parametri[$r]["naziv"] = $naziv;
                        if ($k === false) {
                            $parametri[$r]["mjernaJedinica"] = $mjernaJedinica;
                        }else {
                            $parametri[$r]["mjernaJedinica"] = NULL;
                        }
                        $r = $r + 1;
                        break;
                    default :
                        preusmjeri(\route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "displayDodavanjeVlastitogEksperimenta"
                        )) . "?msg=6");
                }
                
            }
            fclose($handle);
            
            // unos podataka
            $autor = new \model\DBAutor();
            $idA = array();
            for($i = 0; $i < $a; $i = $i + 1) {
                $idA[$i] = $autor->dodajAutora($autori[$i]["ime"], $autori[$i]["prezime"]);
            }
            
            
            $eksperiment = new \model\DBZnanstveniEksperiment();
            $eksperiment->naziv = $naslov;
            $eksperiment->vrijemePocetka = $start;
            $eksperiment->vrijemeZavrsetka = $end;
            $eksperiment->vidljivost = "I";
            $eksperiment->save();
            
            $idEksperimenta = $eksperiment->getPrimaryKey();
            
            // sad zabiljezi autora
            $veza = new \model\DBAutorEksperimenta();
            for($j = 0; $j < $i; $j = $j + 1) {
                $veza->id = null;
                $veza->idAutora = $idA[$j];
                $veza->idEksperimenta = $idEksperimenta;
                $veza->save();
            }
                        
            // zabiljezi platformu
            if(count($platforms)) {
                foreach($platforms as $k => $v) {
                    $koristi = new \model\DBKoristi();
                    $koristi->id = null;
                    $koristi->idPlatforme = $v;
                    $koristi->idEksperimenta = $idEksperimenta;
                    $koristi->save();
                }
            }
            
            //zabiljezi parametre
            $parametar = new \model\DBParametar();
            $pripadaju = new \model\DBPripadaju();
            for ($i = 0; $i < $p; $i = $i + 1) {
                $idParametra = $parametar->dodajParametar($parametri[$i]["naziv"], $parametri[$i]["ispitniSlucaj"]);
                $pripadaju->id = null;
                $pripadaju->idEksperimenta = $idEksperimenta;
                $pripadaju->idParametra = $idParametra;
                $pripadaju->save();
            }
            
            // zabilježi rezultate
            $rezultat = new \model\DBRezultat();
            $ostvario = new \model\DBOstvario();
            
            for ($i = 0; $i < $r; $i = $i + 1) {
                $idRezultata = $rezultat->dodajRezultat($rezultati[$i]["naziv"], $rezultati[$i]["iznos"], $rezultati[$i]["mjernaJedinica"]);
                $ostvario->id = null;
                $ostvario->idEksperimenta = $idEksperimenta;
                $ostvario->idRezultata = $idRezultata;
                $ostvario->save();
            } 
            
            // zabiljezi alate i ide
            if(count($tools)) {
                foreach($tools as $k => $v) {
                    $ostvaren = new \model\DBOstvaren();
                    $ostvaren->id = null;
                    $ostvaren->idAlata = $v;
                    $ostvaren->idEksperimenta = $idEksperimenta;
                    $ostvaren->save();
                }
            }
            
            if(count($ides)) {
                foreach($ides as $k => $v) {
                    $ostvaren = new \model\DBUraden();
                    $ostvaren->id = null;
                    $ostvaren->idIDE = $v;
                    $ostvaren->idEksperimenta = $idEksperimenta;
                    $ostvaren->save();
                }
            }
            
            // josh ga dodam u portfelj
            $portfelj = new \model\DBPortfelj();
            $portfelj->idKorisnika = $_SESSION['auth'];
            $portfelj->idEksperimenta = $idEksperimenta;
            $portfelj->save();
            
        } else {
            // provjera vremena:
            $pattern = '/^(0[0-9]|[1-2][0-9]|3[01])\.(0[0-9]|1[0-2])\.([0-9]{4})\. ([01][0-9]|2[0-4]):[0-5][0-9]$/';
            $vrijeme1 = post("vrijemePocetka");
            $vrijeme2 = post("vrijemeZavrsetka");
            
            if($this->test_pattern($pattern, $vrijeme1) === false || $this->test_pattern($pattern, $vrijeme2) === false) {
                 preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeVlastitogEksperimenta"
            )) . "?msg=3");
            }
            
            // provjera parametara naziv-ispitniSlucaj
            $pattern1 = '/^[A-Za-z0-9čćžđšČĆŽĐŠ]{1,}-[A-Za-z0-9čćžšđČĆŽŠĐ]{1,}$/u';
            $ispravno = true;
            $izraz = post("parametri");
            if(strpos($izraz, ";") === false) {
                if($this->test_pattern($pattern1, $izraz) === false) {
                    preusmjeri(\route\Route::get('d3')->generate(array(
                        "controller" => "korisnik",
                        "action" => "displayDodavanjeVlastitogEksperimenta"
                    )) . "?msg=4");
                }
            } else {
                for($i = strpos($izraz, ";"); $i !== false; $i = strpos($izraz, ";")) {
                    $ispravno = $this->test_pattern($pattern1, substr($izraz, 0, $i));
                    $izraz = substr($izraz, $i + 1);
                    if($ispravno === false) {
                        break;
                    }
                }
                $ispravno = $this->test_pattern($pattern1, $izraz);
            }
            
            if($ispravno === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                        "controller" => "korisnik",
                        "action" => "displayDodavanjeVlastitogEksperimenta"
                    )) . "?msg=4");
            }

            // provjera rezultata
            $pattern2 = '/^[A-Za-z0-9čćžđšČĆŽĐŠ]{1,}-[0-9]{1,}\.{0,1}[0-9]*-[A-Za-z]{1,10}$/u';
            $ispravno = true;
            $izraz2 = post("rezultati");
            if(strpos($izraz2, ";") === false) {
                if($this->test_pattern($pattern2, $izraz2) === false) {
                    preusmjeri(\route\Route::get('d3')->generate(array(
                        "controller" => "korisnik",
                        "action" => "displayDodavanjeVlastitogEksperimenta"
                    )) . "?msg=5");
                }
            } else {
                for($i = strpos($izraz2, ";"); $i !== false; $i = strpos($izraz2, ";")) {
                    $ispravno = $this->test_pattern($pattern2, substr($izraz2, 0, $i));
                    $izraz2 = substr($izraz2, $i + 1);
                    if($ispravno === false) {
                        break;
                    }
                }
                $ispravno = $this->test_pattern($pattern2, $izraz2);
                
            }
            
            if($ispravno === false) {
                preusmjeri(\route\Route::get('d3')->generate(array(
                        "controller" => "korisnik",
                        "action" => "displayDodavanjeVlastitogEksperimenta"
                    )) . "?msg=5");
            }
            
            // sve provjereno sad dodajem u bazu
            $korisnik = new \model\DBKorisnik();
            try {
                $korisnik->load($_SESSION['auth']);
            } catch (opp\model\NotFoundException $e) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
            }
            
            $autor = new \model\DBAutor();
            $idAutora = $autor->dodajAutora($korisnik->ime, $korisnik->prezime);
            
            $eksperiment = new \model\DBZnanstveniEksperiment();
            $eksperiment->naziv = post("naziv");
            $eksperiment->vrijemePocetka = date("Y-m-d H:i:s", strtotime(post("vrijemePocetka")));
            $eksperiment->vrijemeZavrsetka = date("Y-m-d H:i:s", strtotime(post("vrijemeZavrsetka")));
            $eksperiment->vidljivost = "I";
            $eksperiment->save();
            
            $idEksperimenta = $eksperiment->getPrimaryKey();
            
            // sad zabiljezi autora
            $veza = new \model\DBAutorEksperimenta();
            $veza->idAutora = $idAutora;
            $veza->idEksperimenta = $idEksperimenta;
            $veza->save();
            
            // zabiljezi platformu
            if(post("platforma") !== false) {
                $koristi = new \model\DBKoristi();
                $koristi->idPlatforme = post("platforma");
                $koristi->idEksperimenta = $idEksperimenta;
                $koristi->save();
            }
            
            //zabiljezi parametre
            $parametar = new \model\DBParametar();
            $pripadaju = new \model\DBPripadaju();
            $izraz = post("parametri");
            for($i = strpos($izraz, ";"); $i !== false; $i = strpos($izraz, ";")) {
                $j = strpos($izraz, "-");
                $idParametra = $parametar->dodajParametar(substr($izraz, 0, $j), substr($izraz, $j + 1, $i - $j - 1));
                $pripadaju->id = null;
                $pripadaju->idParametra = $idParametra;
                $pripadaju->idEksperimenta = $idEksperimenta;
                $pripadaju->save();
                $izraz = substr($izraz, $i + 1);
            }
            $j = strpos($izraz, "-");
            $idParametra = $parametar->dodajParametar(substr($izraz, 0, $j), substr($izraz, $j + 1));
            $pripadaju->id = null;
            $pripadaju->idParametra = $idParametra;
            $pripadaju->idEksperimenta = $idEksperimenta;
            $pripadaju->save();
            
            // zabilježi rezultate
            $rezultat = new \model\DBRezultat();
            $ostvario = new \model\DBOstvario();
            
            $izraz = post("rezultati");
            for($i = strpos($izraz, ";"); $i !== false; $i = strpos($izraz, ";")) {
                $j = strpos($izraz, "-");
                $k = strpos($izraz, "-", $j + 1);
                $idRezultata = $rezultat->dodajRezultat(substr($izraz, 0, $j), substr($izraz, $j + 1, $k - $j - 1), substr($izraz, $k + 1, $i - $k - 1));
                $ostvario->id = null;
                $ostvario->idRezultata = $idRezultata;
                $ostvario->idEksperimenta = $idEksperimenta;
                $ostvario->save();
                $izraz = substr($izraz, $i + 1);
            }
            $j = strpos($izraz, "-");
            $k = strpos($izraz, "-", $j + 1);
            $idRezultata = $rezultat->dodajRezultat(substr($izraz, 0, $j), substr($izraz, $j + 1, $k - $j - 1), substr($izraz, $k + 1));
            $ostvario->id = null;
            $ostvario->idRezultata = $idRezultata;
            $ostvario->idEksperimenta = $idEksperimenta;
            $ostvario->save();  
            
            // josh ga dodam u portfelj
            $portfelj = new \model\DBPortfelj();
            $portfelj->idKorisnika = $_SESSION['auth'];
            $portfelj->idEksperimenta = $idEksperimenta;
            $portfelj->save();
        }
        
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "korisnik"
        )) . "?msg=14");
    }

    public function displayDodavanjeAlataIde() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
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
            case 4:
                $error = "Morate unijeti brojčanu vrijednost za cijenu!";
                break;
            default:
                break;
        }
        
        $e = new \model\DBZnanstveniEksperiment();
        $eks = $e->dohvatiInterneEksperimente($_SESSION['auth']);
        
        echo new \view\Main(array(
            "body" => new \view\DodavanjeAlataIde(array(
                "errorMessage" => $error,
                "eksperimenti" => $eks
            )),
            "title" => "Dodavanje Alata i Razvojnih Okruženja"
        ));
    }
    
    private function test_pattern($pattern, $data) {
            if (false === is_string($data)) {
                    return false;
            } else {
                    return preg_match($pattern, $data)?true:false;
            }
    }
    
    public function dodajAlatIde() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(post("naziv") === false || post("skraceni") === false || post("inacica") === false || post("cijena") === false || post("eksperiment") === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=1");
        }
        
        $pattern = '/^[A-Za-z0-9]{1,}$/u';
        $pov = $this->test_pattern($pattern, post("skraceni"));
        if($pov === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=2");
        }
        
        // format cijene;
        $pattern1 = '/^[0-9]{1,}\.{0,1}[0-9]{0,}$/u';
        $pov1 = $this->test_pattern($pattern1, post("cijena"));
        
        if($pov1 === false) {
            preusmjeri(\route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
            )) . "?msg=4");
        }
 
        if(post("checked") == true) {
            // znaci da dodajem alat
            $alat = new \model\DBAlat();
            if($alat->loadSkraceniNaziv(post("skraceni")) == true) {
                $id = $alat->dohvatiId(post("skraceni"));
                $ostvaren = new \model\DBOstvaren();
                $ostvaren->idEksperimenta = post("eksperiment");
                $ostvaren->idAlata = $id;
                $ostvaren->povezi($id, post("eksperiment"));
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik",
                )) . "?msg=15");
            } else {
                $alat->naziv = post("naziv");
                $alat->skraceniNaziv = post("skraceni");
                $alat->inacica = post("inacica");
                $alat->cijena = post("cijena");
                $alat->vidljivost = 'I';
                $alat->link = NULL;
                $alat->save();
                
                $ostvaren = new \model\DBOstvaren();
                $ostvaren->idEksperimenta = post("eksperiment");
                $ostvaren->idAlata = $alat->getPrimaryKey();
                $ostvaren->save();
            }
            
        } else {
            // dodajem Ide
            // znaci da dodajem alat
            $alat = new \model\DBIde();
            if($alat->loadSkraceniNaziv(post("skraceni")) == true) {
                $id = $alat->dohvatiId(post("skraceni"));
                $uraden = new \model\DBUraden();
                $uraden->idEksperimenta = post("eksperiment");
                $uraden->idIDE = $id;
                $uraden->povezi($id, post("eksperiment"));
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik",
                )) . "?msg=15");
            } else {
                $alat->naziv = post("naziv");
                $alat->skraceniNaziv = post("skraceni");
                $alat->inacica = post("inacica");
                $alat->cijena = post("cijena");
                $alat->vidljivost = 'I';
                $alat->save();
                
                $uraden = new \model\DBUraden();
                $uraden->idIDE = $alat->getPrimaryKey();
                $uraden->idEksperimenta = post("eksperiment");
                $uraden->save();
            }
        }

        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "korisnik"
        )) . "?msg=14");
    }
    
    public function displayPredlaganjeNovogRada() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $error=null;
        
        $s = new \model\DBZnanstveniSkup();
        $skupovi = $s->select()->fetchAll();
        
        $c = new \model\DBZnanstveniCasopis();
        $casopisi = $c->select()->fetchAll();
        
        echo new \view\Main(array(
            "body" => new \view\PredlaganjeNovogRada(array(
                "errorMessage" => $error,
                "skupovi" => $skupovi,
                "casopisi" => $casopisi
            )),
            "title" => "Predlaganje Novog Znanstvenog Rada"
        ));
    }
    
    public function prijedlogRada() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if((post("skup") === false && post("casopis") === false && post("tekst") === false)){
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=11");
        }
        
        if(post("url") === false && files('tmp_name', "datoteka") === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            )) . "?msg=10");
        }
        
        $prijedlog = new \model\DBPrijedlozi();
        
        //provjeri je li pdf
        if(files("tmp_name", "datoteka") !== false) {
            if(function_exists('finfo_file')) {
                $finfo = \finfo_open(FILEINFO_MIME_TYPE);
                $mime = finfo_file($finfo, files("tmp_name", "datoteka"));
            } else {
                $mime = \mime_content_type(files("tmp_name", "datoteka"));
            }
            if($mime != 'application/pdf') {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=13");
            }
            //$prijedlog->lokacija = ;
            // snimam ga nakon ovoga u formatu idPrijedloga.pdf
        } else {
            $prijedlog->lokacija = post("url", null);
        }

        // spremi prijedlog
        $prijedlog->idKorisnika = $_SESSION['auth'];
        $prijedlog->naslov = post("naslov", null);
        $prijedlog->sazetak = post("sazetak", null);
        $prijedlog->autori = post("autori", null);
        $prijedlog->kljucneRijeci = post("tag", null);
        
        $prijedlog->idSkupa = post("skup", null);
        $prijedlog->idCasopisa = post("casopis", null);
        $prijedlog->tekst = post("tekst", null);
        
        $prijedlog->save();
        
         if(files("tmp_name", "datoteka") !== false) {
             $destination = "./pdf/" . $prijedlog->getPrimaryKey() . ".pdf";
             if(false === move_uploaded_file(files("tmp_name", "datoteka"), $destination)) {
                 preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=13");
             }
             $prijedlog->lokacija = $destination;
             $prijedlog->save();
         }
        
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "korisnik"
        )) . "?msg=12");
    }


    public function displayPredlaganjeKorekcije() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(get("id") === false) {
            if(get("v") == 'E') {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=3");
            } else if(get("v") == 'R') {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=7");
            } else {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
            }
        } else {
            if(get("v") === FALSE) {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
            }
            
            $id = null;
            $vrsta = null;
            $error = null;
            
            if(get("v") == 'R') {
                try {
                    $rad = new \model\DBZnanstveniRad();
                    $rad->load(get("id"));
                    $id = get("id");
                    $vrsta = 'R';
                } catch (opp\model\NotFoundException $e) {
                    preusmjeri(\route\Route::get('d2')->generate(array(
                        "controller" => "korisnik"
                    )) . "?msg=7");
                }
            } else if(get("v") == 'E') {
                try {
                    $rad = new \model\DBZnanstveniEksperiment();
                    $rad->load(get("id"));
                    $id = get("id");
                    $vrsta = 'E';
                } catch (opp\model\NotFoundException $e) {
                    preusmjeri(\route\Route::get('d2')->generate(array(
                        "controller" => "korisnik"
                    )) . "?msg=3");
                }
            } else {
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "korisnik"
                )) . "?msg=6");
            }
            
            echo new \view\Main(array(
                "body" => new \view\PredlaganjeKorekcije(array(
                    "errorMessage" => $error,
                    "id" => $id,
                    "v" => $vrsta
                )),
                "title" => "Predlaganje Korekcije"
            ));
        }
    }
    
    public function predloziKorekciju() {
        // ako nisi logiran bjezi odavde
        if (!\model\DBKorisnik::isLoggedIn() || $_SESSION['vrsta'] != 'K') {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        if(post(tekst) === false) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "korisnik",
            )) . "?msg=2");
        } else {
            $prijedlog = new \model\DBPrijedlozi();
            $prijedlog->idKorisnika = $_SESSION['auth'];
            $prijedlog->tekst = post("tekst");
            if(post("v") == 'E') {
                $prijedlog->idEksperimenta = post("id");
            } else {
                $prijedlog->idRada = post("id");
            }
            $prijedlog->save();
            
            preusmjeri(\route\Route::get("d2")->generate(array(
                "controller" => "korisnik"
            )) . "?msg=1");
        }
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
