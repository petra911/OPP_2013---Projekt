<?php

namespace model;
use opp\model\AbstractDBModel;

class DBRezultat extends AbstractDBModel {
    public function getTable() {
        return 'rezultat';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idRezultata';
    }
    
    public function getColumns() {
        return array('naziv', 'iznos', 'mjernaJedinica');
    }
    
    public function dodajRezultat($naziv, $iznos, $mjernaJedinica) {
        $this->idRezultata = null;
        $pov = $this->select()->where(array(
            "naziv" => $naziv,
            "iznos" => $iznos,
            "mjernaJedinica" => $mjernaJedinica
        ))->fetchAll();
        
        if(count($pov)) {
            return $pov[0]->idRezultata;
        } else {
            $this->naziv = $naziv;
            $this->iznos = $iznos;
            $this->mjernaJedinica = $mjernaJedinica;
            $this->save();
            return $this->getPrimaryKey();
        }
    }
}