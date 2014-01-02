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
            default:
                break;
        }
        
        echo new \view\Main(array(
            "body" => new \view\Portfelj(array(
                "errorMessage" => $this->errorMessage
            )),
            "title" => "Portfelj"
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
}
