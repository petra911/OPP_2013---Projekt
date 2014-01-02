<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPortfelj extends AbstractDBModel {
    public function getTable() {
        return 'portfelj';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idZapisa';
    }
    
    public function getColumns() {
        return array('idKorisnika', 'idEksperimenta', 'idRada');
    }
    
    public function postojiZapis($idKorisnika = null, $idEksperimenta = null, $idRada = null) {
        $pov = $this->select()->where(array(
            "idKorisnika" => $idKorisnika,
            "idEksperimenta" => $idEksperimenta,
            "idRada" => $idRada
        ))->fetchAll();
        
        if(count($pov)) {
            return true;
        } else return false;
    }
    
    public function dohvatiZapise($idKorisnika) {
        return $this->select()->where(array(
            "idKorisnika" => $idKorisnika
        ))->fetchAll();
    }
    
    public function brisiZapis($idKorisnika = null, $idEksperimenta = null, $idRada = null) {
        $pov = $this->select()->where(array(
            "idKorisnika" => $idKorisnika,
            "idEksperimenta" => $idEksperimenta,
            "idRada" => $idRada
        ))->fetchAll();
        
        if(count($pov)) {
            $pov[0]->delete();
            return true;
        }
        return false;
    }
}