<?php

namespace model;
use opp\model\AbstractDBModel;

class DBKoristi extends AbstractDBModel {
    public function getTable() {
        return 'koristi';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idPlatforme', 'idEksperimenta');
    }
}
