<?php

namespace model;
use opp\model\AbstractDBModel;

class DBAutor extends AbstractDBModel {
    public function getTable() {
        return 'autor';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idAutora';
    }
    
    public function getColumns() {
        return array('ime', 'prezime');
    }
        
    public function dohvatiAutore($prezime) {
        return $this->select()->where(array(
            "prezime" => $prezime
        ))->fetchAll();
    }
    
    public function dodajAutora($ime, $prezime) {
        $this->idAutora = null;
        $pov = $this->select()->where(array(
            "ime" => $ime,
            "prezime" => $prezime
        ))->fetchAll();

        if(count($pov)) {
            return $pov[0]->idAutora;
        } else {
            $this->idAutora = null;
            $this->ime = $ime;
            $this->prezime = $prezime;
            $this->save();
            return $this->getPrimaryKey();
        }
    }
    
}