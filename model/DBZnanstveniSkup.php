<?php

namespace model;
use opp\model\AbstractDBModel;

class DBZnanstveniSkup extends AbstractDBModel {
    public function getTable() {
        return 'znanstveniskup';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idSkupa';
    }
    
    public function getColumns() {
        return array('naziv', 'mjesto', 'drzava', 'danPocetka', 'danZavrsetka', 'adresa');
    }
    
     public function dohvatiZnanstveneSkupove(){
        return $this->select()->fetchAll();
    
    }
    
    public function brisiZnanstveniSkup($primaryKey) {
        try {
            $this->load($primaryKey);
        }  catch (\opp\model\NotFoundException $e) {
            return false;
        }
        $this->delete();
        return true;
    }
    
}