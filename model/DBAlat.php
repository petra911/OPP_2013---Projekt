<?php

namespace model;
use opp\model\AbstractDBModel;

class DBAlat extends AbstractDBModel {
    public function getTable() {
        return 'alat';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idAlata';
    }
    
    public function getColumns() {
        return array('naziv', 'skraceniNaziv', 'inacica', 'cijena', 'vidljivost', 'link');
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
}
