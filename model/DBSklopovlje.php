<?php

namespace model;
use opp\model\AbstractDBModel;

class DBSklopovlje extends AbstractDBModel {
    public function getTable() {
        return 'sklopovlje';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idSklopovlja';
    }
    
    public function getColumns() {
        return array('karakteristika', 'skraceniNaziv');
    }
    
    public function loadSkraceniNaziv($skraceniNaziv) {
        $pov = $this->select()->where(array(
            "skraceniNaziv" => $skraceniNaziv
        ))->fetchAll();
        
        if (count($pov)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function dohvatiId($skraceniNaziv) {
        $pov = $this->select()->where(array(
            "skraceniNaziv" => $skraceniNaziv
        ))->fetchAll();
        
        if(count($pov)) {
            return $pov[0]->idAlata;
        } else {
            return false;
        }
            
    }
    
    public function dohvatiSklopovlja(){
        return $this->select()->fetchAll();
    
    }
    
    public function brisiSklopovlje($primaryKey) {
        try {
            $this->load($primaryKey);
        }  catch (\opp\model\NotFoundException $e) {
            return false;
        }
        $this->delete();
        return true;
    }
}
