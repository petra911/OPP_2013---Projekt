<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPripada extends AbstractDBModel {
    public function getTable() {
        return 'pripada';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idRada', 'idEksperimenta');
    }
}
