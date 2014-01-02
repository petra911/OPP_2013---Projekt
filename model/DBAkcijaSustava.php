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
    
}