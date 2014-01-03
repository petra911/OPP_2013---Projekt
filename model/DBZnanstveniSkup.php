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
}