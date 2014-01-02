<?php

namespace model;
use opp\model\AbstractDBModel;

class DBOcjena extends AbstractDBModel {
    public function getTable() {
        return 'ocjena';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idOcjene';
    }
    
    public function getColumns() {
        return array('oznaka', 'ocjena');
    }
    
}