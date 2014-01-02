<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPoruke extends AbstractDBModel {
    public function getTable() {
        return 'poruke';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idPrimatelja', 'idPosiljatelja', 'tekst');
    }
    
    public function dohvatiPoruke($idPrimatelja) {
        return $this->select()->where(array(
            "idPrimatelja" => $idPrimatelja
        ))->fetchAll();
    }
    
    public function brisiPoruke($idPrimatelja) {
        $pov = $this->dohvatiPoruke($idPrimatelja);
        if(count($pov)) {
            foreach($pov as $p) {
                $p->delete();
            }
        }
    }
    
    public function dohvatiPoruku($idPosiljatelja, $idPrimatelja) {
        $pov = $this->select()->where(array(
            "idPrimatelja" => $idPrimatelja,
            "idPosiljatelja" => $idPosiljatelja
        ))->fetchAll();
        
        if(count($pov)) {
            return $pov[0]->tekst;
        } else {
            return false;
        }
    }
    
    public function brisiPoruku($idPosiljatelja, $idPrimatelja) {
        $pov = $this->select()->where(array(
            "idPrimatelja" => $idPrimatelja,
            "idPosiljatelja" => $idPosiljatelja
        ))->fetchAll();
        
        if(count($pov)) {
            $pov[0]->delete();
        } else {
            return false;
        }
        return true;
    }
}
