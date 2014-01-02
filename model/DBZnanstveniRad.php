<?php

namespace model;
use opp\model\AbstractDBModel;

class DBZnanstveniRad extends AbstractDBModel {
    public function getTable() {
        return 'znanstvenirad';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idRada';
    }
    
    public function getColumns() {
        return array('naslov', 'sazetak', 'lokacija', 'idCasopisa', 'idSkupa');
    }
}
