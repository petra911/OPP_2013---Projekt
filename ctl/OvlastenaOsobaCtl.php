<?php

namespace ctl;
use opp\controller\Controller;

class OvlastenaOsobaCtl implements Controller {
    
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
}