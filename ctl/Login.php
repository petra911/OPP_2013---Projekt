<?php

namespace ctl;
use opp\controller\Controller;

class Login implements Controller {
    
    private $errorMessage;
    
    public function display() {
        // ako si vec logiran bjezi odavde
        if (\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }

        if(get('neispravno') == 1) {
            $this->errorMessage = 'Neispravno popunjena polja!';
	} elseif (get('neispravno') == 2) {
            $this->errorMessage = 'Vaš račun nije još uvijek aktiviran. Molimo pokušajte kasnije!';
        } elseif (get('neispravno') == 3) {
            $this->errorMessage = 'Uspješno ste se registrirali!';
        }
        
        echo new \view\Main(array(
            "body" => new \view\Login(array(
                "errorMessage" => $this->errorMessage
            )),
            "title" => "Login"
        ));
    }
    
    public function login() {
        if(!post("userName") || !post("pass")) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "login"
            )) . "?neispravno=1");
        }

        $validacija = new \model\LoginFormModel(post("userName"), post("pass"));
        $pov = $validacija->validate();
        if (true !== $pov) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "login"
            )) . "?neispravno=1");
        }
        
        $korisnik = new \model\DBKorisnik();
        if($korisnik->doAuth(post("userName"), post("pass"))) {
            // preusmjeri ga na naslovnicu s odgovarajućom porukom
            // prvo provjeri je li validiran
            if($korisnik->testValidnost()) {
                preusmjeri(\route\Route::get('d1')->generate());
            } else {
                session_destroy();
                preusmjeri(\route\Route::get('d2')->generate(array(
                    "controller" => "login"
                )) . "?neispravno=2");
            }
        } else {
            // posalji ga da se registrira
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "register"
            )));
        }
    }
    
}