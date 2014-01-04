<?php

namespace model;
use opp\model\AbstractDBModel;

class DBOstvario extends AbstractDBModel {
    public function getTable() {
        return 'ostvario';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idEksperimenta', 'idRezultata');
    }
}
