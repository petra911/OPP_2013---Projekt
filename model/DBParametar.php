<?php

namespace model;
use opp\model\AbstractDBModel;

class DBParametar extends AbstractDBModel {
    public function getTable() {
        return 'parametar';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idParametra';
    }
    
    public function getColumns() {
        return array('naziv', 'ispitniPrimjer');
    }
    
    public function dodajParametar($naziv, $ispitniPrimjer) {
        $this->idParametra = null;
        $pov = $this->select()->where(array(
            "naziv" => $naziv,
            "ispitniPrimjer" => $ispitniPrimjer
        ))->fetchAll();
        
        if(count($pov)) {
            return $pov[0]->idParametra;
        } else {
            $this->naziv = $naziv;
            $this->ispitniPrimjer = $ispitniPrimjer;
            $this->save();
            return $this->getPrimaryKey();
        }
    }
}