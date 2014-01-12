<?php

namespace model;
use opp\model\AbstractDBModel;

class DBIde extends AbstractDBModel {
    public function getTable() {
        return 'ide';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idIDE';
    }
    
    public function getColumns() {
        return array('naziv', 'skraceniNaziv', 'inacica', 'cijena', 'vidljivost');
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
            return $pov[0]->idIDE;
        } else {
            return false;
        }
            
    }
    
    public function dohvatiIDE(){
        return $this->select()->fetchAll();
    
    }
    
    public function brisiIDE($primaryKey) {
        try {
            $this->load($primaryKey);
        }  catch (\opp\model\NotFoundException $e) {
            return false;
        }
        $this->delete();
        return true;
    }
}
