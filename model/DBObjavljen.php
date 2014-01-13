<?php

namespace model;
use opp\model\AbstractDBModel;

class DBObjavljen extends AbstractDBModel {
    public function getTable() {
        return 'objavljen';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idRada', 'idCasopisa');
    }
}
