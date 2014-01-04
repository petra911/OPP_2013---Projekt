<?php

namespace model;
use opp\model\AbstractDBModel;

class DBAutorEksperimenta extends AbstractDBModel {
    public function getTable() {
        return 'autoreksperimenta';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idAutora', 'idEksperimenta');
    }
}