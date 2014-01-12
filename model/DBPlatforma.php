<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPlatforma extends AbstractDBModel {
    public function getTable() {
        return 'platforma';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idPlatforme';
    }
    
    public function getColumns() {
        return array('tip', 'naziv', 'skraceniNaziv', 'inacica', 'link', 'datasheet', 'cijena');
    }
    
    public function postojiSkraceniNaziv($skraceniNaziv) {
        $pov = $this->select()->where(array(
            "skraceniNaziv" => $skraceniNaziv
        ))->fetchAll();
        
        if(count($pov)) {
            return true;
        }
        return false;
    }
    
    public function dohvatiPlatforme(){
        return $this->select()->fetchAll();
    
    }
    
    public function brisiPlatformu($primaryKey) {
        try {
            $this->load($primaryKey);
        }  catch (\opp\model\NotFoundException $e) {
            return false;
        }
        $this->delete();
        return true;
    }
}
