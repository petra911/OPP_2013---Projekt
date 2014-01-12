<?php

namespace ctl;
use opp\controller\Controller;

class Register implements Controller {
    private $ispis;
    
    public function register() {
        if(\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $akcijeSustava = new \model\DBAkcijaSustava();
        if(!post("userName") || !post("pass") || !post("datum") || !post("ime") || !post("prez") || !post("mail")) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "register"
            )) . "?msg=2");
        }
        $validacija = new \model\RegisterFormModel(post("userName"), post("pass"), post("datum"), post("ime"), post("prez"), post("mail"));
        $pov = $validacija->validate();
        
        if(true !== $pov) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "register"
            )) . "?msg=1");
        }
        
        // provjeri je li postoji vec takav korisnik
        $korisnik = new \model\DBKorisnik();
        $korisnik->ime = post("ime", '');
        $korisnik->prezime = post("prez", '');
        $korisnik->mail = post("mail");
        $korisnik->datumRod = date('Y-m-d', strtotime(post("datum")));
        if (strtotime($korisnik->datumRod) > time() - 24 * 3600 * 30 * 60) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "register"
            )) . "?msg=4");
        }
        $korisnik->username = post("userName");
        $korisnik->password = post("pass");
        $korisnik->vrsta = 'K';             // na ovaj način se mogu registrirati samo obični korisnici
        $korisnik->validnost = '0';
        $korisnik->uplata = '';
        
        try {
            $korisnik->saveNewUser();
            $akcijeSustava->zabiljeziNovuAkciju($korisnik->getPrimaryKey(), date("Y-m-d H:i:s"), "Registriran " . $korisnik->getPrimaryKey());
        }  catch (\opp\model\UserAlreadyExistsException $e) {
            preusmjeri(\route\Route::get('d2')->generate(array(
                "controller" => "register"
            )) . "?msg=3");
        }
        
        // sve ok vrati ga na login
        preusmjeri(\route\Route::get('d2')->generate(array(
            "controller" => "login"
        )) . '?neispravno=3');
    }
    
    private function checkErrorMessage() {
        switch (get('msg')) {
            case 1:
                $this->ispis = 'Neispravno popunjen obrazac!';
                break;
            case 2:
                $this->ispis = 'Sva polja moraju biti popunjena!';
                break;
            case 3:
                $this->ispis = 'Korisnik već postoji!';
                break;
            case 4:
                $this->ispis = 'Morate biti stariji od 5 godina!';
                break;
            default: break;
        }
    }
    
    public function display() {
        if(\model\DBKorisnik::isLoggedIn()) {
            preusmjeri(\route\Route::get('d1')->generate());
        }
        
        $this->checkErrorMessage();
        
        echo new \view\Main(array(
            "title" => 'Registracija',
            "body" => new \view\Register(array(
                "errorMessage" => $this->ispis
            ))
        ));
    }
}