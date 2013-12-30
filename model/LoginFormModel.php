<?php

namespace model;
use opp\model\Model;

class LoginFormModel implements Model {
    
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
    
    /**
     * 
     * @return string|boolean   opis pogreške|true ako je sve ok
     */
    public function validate() {
        $pov = $this->validateUsername($this->userName);
        if ($pov === false) {
            return "Pogrešno korisničko ime!";
        }
        
        $pov = $this->validatePassword($this->pass);
        if ($pov === false) {
            return "Pogrešna lozinka!";
        }
        return true;
    }
    
    public function __construct($user, $pass) {
        $this->userName = $user;
        $this->pass = $pass;
    }
    
    /**
     * 
     * @param string $userName
     * @return \model\LoginFormModel
     */
    public function setUserName($userName) {
        $this->userName = $userName;
        return $this;
    }

    /**
     * 
     * @param string $pass
     * @return \model\LoginFormModel
     */
    public function setPass($pass) {
        $this->pass = $pass;
        return $this;
    }
    
    public function getUserName() {
        return $this->userName;
    }

    public function getPass() {
        return $this->pass;
    }
    
    public function equals(Model $model) {
        if (get_class($this) !== get_class($model)) {
            return false;
        }
        
        if ($this->pass !== $model->getPass()) return false;
        if ($this->userName !== $model->getUserName()) return false;
        
        return true;
    }
    
    public function serialize() {
        return serialize(array($this->pass, $this->userName));
    }
    
    public function unserialize($serialized) {
        $pom = unserialize($serialized);
        $this->userName = $pom[1];
        $this->pass = $pom[0];
    }
}