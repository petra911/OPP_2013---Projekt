<?php

namespace model;
use opp\model\AbstractDBModel;

class DBKljucneRijeci extends AbstractDBModel {
    public function getTable() {
        return 'kljucnerijeci';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idTaga';
    }
    
    public function getColumns() {
        return array('tag');
    }
	
	public function dohvatiKljucneRijeci($idTaga) {
        return $this->select()->where(array(
            "idTaga" => $idTaga
        ))->fetchAll();
    }
    
}