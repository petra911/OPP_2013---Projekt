<?php

namespace model;
use opp\model\AbstractDBModel;

class DBOcjenjuje extends AbstractDBModel {
    public function getTable() {
        return 'ocjenjuje';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idKorisnika', 'idOcjene', 'idEksperimenta');
    }
    
    public function provjeraOcjene($idKorisnika, $idEksperimenta) {
        $pov = $this->select()->where(array(
            "idKorisnika" => $idKorisnika,
            "idEksperimenta" => $idEksperimenta
        ))->fetchAll();
        
        if(count($pov)) {
            return $pov[0];
        } else {
            return false;
        }
    }
}
