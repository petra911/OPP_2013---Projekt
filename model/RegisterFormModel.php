<?php

namespace model;
use opp\model\Model;

class RegisterFormModel implements Model {
    
    /**
     *
     * @var string 
     */
    private $userName;
    /**
     *
     * @var string 
     */
    private $pass;
    
    /**
     *
     * @var mixed 
     */
    private $datum;
    /**
     *
     * @var string
     */
    private $ime;
    /**
     *
     * @var string 
     */
    private $prezime;
    /**
     *
     * @var string 
     */
    private $mail;
    
    public function __construct($userName, $pass, $datum, $ime, $prezime, $mail) {
        $this->userName = $userName;
        $this->pass = $pass;
        $this->datum = $datum;
        $this->ime = $ime;
        $this->prezime = $prezime;
        $this->mail = $mail;
    }

    /**
     * Vrsi provjeru prema navedenom uzorku
     * vraca true ako podatak odgovara uzorku
     * inace false
     */
    private function test_pattern($pattern, $data) {
            if (false === is_string($data)) {
                    return false;
            } else {
                    return preg_match($pattern, $data)?true:false;
            }
    }
    
    /**
     * Provjerava je li dobivena vrijednost ispravan password
     * Password ima min 6 max 18 znakova (slova i znamenke)
     * 
     * @param {mixed}						podatak koji je potrebno validirati
     * @return {boolean}					true ako je podatak zbilja ispravno napisan password
     */
    private function validatePassword($data) {
            $pattern = '/^[a-zA-Z0-9]{6,18}$/';
            return $this->test_pattern($pattern, $data);
    }
    
    /**
     * Provjerava je li dobivena vrijednost ispravan username
     * Korisnicko ime ima min 3 max 16 znakova
     * 
     * @param {mixed}						podatak koji je potrebno validirati
     * @return {boolean}					true ako je podatak zbilja ispravno napisan username
     */
    private function validateUsername($data) {
            $pattern = '/^[a-zA-Z0-9_-]{3,16}$/';
            return $this->test_pattern($pattern, $data);
    }
    
    private function validateIme($data) {
        $pattern = '/^[A-ZČĆŽĐŠ][a-zčćžđš]{2,30}$/u';
        return $this->test_pattern($pattern, $data);
    }

    private function validatePrezime($data) {
        $pattern = '/^[A-ZČĆŽĐŠ][a-zčćžđš]{2,30}$/u';
        return $this->test_pattern($pattern, $data);
    }
    
    /**
     * Provjerava je li dobivena vrijednost ispravna email adresa.
     * 
     * @param {mixed}						podatak koji je potrebno validirati
     * @return {boolean}					true ako je podatak zbilja email adresa
     */
    public function validateMail($data) {
            $pattern = '/^[A-Za-z0-9_.+-]+@(?:[A-Za-z0-9]+\.)+[A-Za-z]{2,3}$/';
            return $this->test_pattern($pattern, $data);
    }
    
    public function validateDatum($data) {
        $this->datum = strtotime($data);
        return $this->datum == false ? false : true;
    }

    public function validate() {
        $pov = $this->validateUsername($this->userName);
        if ($pov === false) {
            return "Pogrešno korisničko ime!";
        }
        
        $pov = $this->validatePassword($this->pass);
        if ($pov === false) {
            return "Pogrešna lozinka!";
        }
        $pov = $this->validateIme($this->ime);
        if ($pov === false) {
            return "Pogrešno ime!";
        }
        $pov = $this->validatePrezime($this->prezime);
        if ($pov === false) {
            return "Pogrešno prezime!";
        }
        $pov = $this->validateMail($this->mail);
        if ($pov === false) {
            return "Pogrešan e-mail!";
        }
        $pov = $this->validateDatum($this->datum);
        if ($pov === false) {
            return "Pogrešan datum!";
        }
        return true;
    }
    
    /**
     * 
     * @param string $userName
     * @return \model\RegisterFormModel
     */
    public function setUserName($userName) {
        $this->userName = $userName;
        return $this;
    }

    /**
     * 
     * @param string $pass
     * @return \model\RegisterFormModel
     */
    public function setPass($pass) {
        $this->pass = $pass;
        return $this;
    }

    public function setDatum($datum) {
        $this->datum = $datum;
        return $this;
    }

    /**
     * 
     * @param string $ime
     * @return \model\RegisterFormModel
     */
    public function setIme($ime) {
        $this->ime = $ime;
        return $this;
    }

    /**
     * 
     * @param string $prezime
     * @return \model\RegisterFormModel
     */
    public function setPrezime($prezime) {
        $this->prezime = $prezime;
        return $this;
    }

    /**
     * 
     * @param string $mail
     * @return \model\RegisterFormModel
     */
    public function setMail($mail) {
        $this->mail = $mail;
        return $this;
    }

    public function getUserName() {
        return $this->userName;
    }

    public function getPass() {
        return $this->pass;
    }

    public function getDatum() {
        return $this->datum;
    }

    public function getIme() {
        return $this->ime;
    }

    public function getPrezime() {
        return $this->prezime;
    }

    public function getMail() {
        return $this->mail;
    }
        
    public function equals(Model $model) {
        if (get_class($this) !== get_class($model)) {
            return false;
        }
        
        if ($this->pass !== $model->getPass()) return false;
        if ($this->userName !== $model->getUserName()) return false;
        if ($this->datum !== $model->getDatum()) return false;
        if ($this->ime !== $model->getIme()) return false;
        if ($this->prezime !== $model->getPrezime()) return false;
        if ($this->mail !== $model->getMail()) return false;
        
        return true;
    }
    
    public function serialize() {
        return serialize(array($this->userName, $this->pass, $this->datum, $this->ime, $this->prezime, $this->mail));
    }
    
    public function unserialize($serialized) {
        $pom = unserialize($serialized);
        $this->userName = $pom[0];
        $this->pass = $pom[1];
        $this->datum = $pom[2];
        $this->ime = $pom[3];
        $this->prezime = $pom[4];
        $this->mail = $pom[5];
    }
}