<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPlatforma extends AbstractDBModel {
    public function getTable() {
        return 'platforma';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idPlatforme';
    }
    
    public function getColumns() {
        return array('tip', 'naziv', 'skraceniNaziv', 'inacica', 'link', 'datasheet', 'cijena');
    }
}
