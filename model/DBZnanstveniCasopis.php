<?php

namespace model;
use opp\model\AbstractDBModel;

class DBZnanstveniCasopis extends AbstractDBModel {
    public function getTable() {
        return 'znanstvenicasopis';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idCasopisa';
    }
    
    public function getColumns() {
        return array('naziv', 'godiste', 'redniBroj', 'adresa');
    }
    
    public function postojiIdenticanCasopis($naziv,$godiste,$redniBroj,$adresa) {
        $pov = $this->select()->where(array(
            "naziv" => $naziv,
            "godiste" => $godiste,
            "redniBroj" => $redniBroj,
            "adresa" => $adresa
        ))->fetchAll();
        
        if(count($pov)) {
            return true;
        }
        return false;
    }
}