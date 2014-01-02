<?php

namespace model;
use opp\model\AbstractDBModel;

class DBZnanstveniEksperiment extends AbstractDBModel {
    public function getTable() {
        return 'znanstvenieksperiment';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idEksperimenta';
    }
    
    public function getColumns() {
        return array('naziv', 'vrijemePocetka', 'vrijemeZavrsetka', 'vidljivost');
    }
}