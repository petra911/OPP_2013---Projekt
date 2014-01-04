<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPripadaju extends AbstractDBModel {
    public function getTable() {
        return 'pripadaju';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idEksperimenta', 'idParametra');
    }
}
