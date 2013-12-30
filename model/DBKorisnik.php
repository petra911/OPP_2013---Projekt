<?php

namespace model;
use opp\model\AbstractDBModel;
use opp\model\UserAlreadyExistsException;

class DBKorisnik extends AbstractDBModel {
    
    /**
     *
     * @var boolean 
     */
    private $isLoggedIn = false;
    
    public function getTable() {
        return 'korisnik';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idKorisnika';
    }
    
    public function getColumns() {
        return array('ime', 'prezime', 'mail', 'datumRod', 'username', 'password', 'vrsta', 'validnost', 'uplata');
    }
    
    private function kriptPass($pass) {
        return sha1($pass);
    }
    
    /**
     * 
     * @param string $user userName
     * @param string $password kriptirani password
     * @return boolean
     */
    public function doAuthRaw($user, $password) {
        $rez = $this->select()->where(array(
            "userName" => $user,
            "password" => $password
        ))->fetch();
        
        if (false === $rez) {
            return false;
        }

        $this->load($rez->getPrimaryKey());
        
        return true;
    }
    
    /**
     * 
     * @param string $userName
     * @param string $password nekriptirani password
     * @return boolean
     */
    public function doAuth($userName, $password) {
        $this->isLoggedIn = $this->doAuthRaw($userName, $this->kriptPass($password));
        
        // u sjednici cuvam idKorisnika i njegovu vrstu
        if ($this->isLoggedIn) {
            $_SESSION["auth"] = $this->getPrimaryKey();
            $_SESSION["vrsta"] = $this->vrsta;
        }
        
        return $this->isLoggedIn;
    }
    
    /**
     * 
     * @return boolean
     */
    public static function isLoggedIn() {
        $pom = isset($_SESSION['auth']) ? $_SESSION['auth'] : null;
        
        if (null === $pom) {
            return false;
        }
        
        return true;
    }
    
    /**
     * provjera je li korisnik validiran (izvršena uplata, odobrena registracija)
     * 
     * @return boolean
     */
    public function testValidnost() {
        if (false === $this->isLoggedIn)
            return false;
        if ($this->validnost == 0)
            return false;
        return true;
    }
    
    public function saveNewUser() {
        $this->password = $this->kriptPass($this->password);
        
        // ne zelim dodavati prazan string u bazu nego null vrijednost
        $this->ime = $this->ime == "" ? null : $this->ime;
        $this->prezime = $this->prezime == "" ? null : $this->prezime;
        $this->uplata = $this->uplata == "" ? null : $this->uplata;
        // provjeri postoji li vec netko s zadanim $username
        $brojac = $this->countQuery()->where(array(
            'username' => $this->username
        ))->fetch()->COUNT;
        
        if ($brojac != 0) {
            throw new UserAlreadyExistsException('Korisnik već postoji!');
        } else {
            $this->save(); 		// dodaj ga u relaciju
        }
    }
    
    public function getValidationRequests() {
        return $this->select()->where(array(
            'validnost' => 0
        ))->fetchAll();
    }
}
