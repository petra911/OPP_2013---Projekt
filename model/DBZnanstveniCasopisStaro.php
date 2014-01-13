<?php

namespace model;
use opp\model\AbstractDBModel;

class DBZnanstveniCasopis extends AbstractDBModel {
    public function getTable() {
        return 'znanstvenicasopis';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idCasopisa';
    }
    
    public function getColumns() {
        return array('naziv', 'godiste', 'redniBroj', 'adresa');
    }
}