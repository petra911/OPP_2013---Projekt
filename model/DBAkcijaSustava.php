<?php

namespace model;
use opp\model\AbstractDBModel;

class DBAkcijaSustava extends AbstractDBModel {
    public function getTable() {
        return 'akcijasustava';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idAkcije';
    }
    
    public function getColumns() {
        return array('idKorisnika', 'vrijeme', 'opisAkcije');
    }
    
    public function zabiljeziNovuAkciju($idKorisnika, $vrijeme, $opisAkcije) {
        $this->idAkcije = null;
        $this->idKorisnika = $idKorisnika;
        $this->vrijeme = $vrijeme;
        $this->opisAkcije = $opisAkcije;
        $this->save();
    }
}