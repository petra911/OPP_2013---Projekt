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
    
}