<?php

namespace model;
use opp\model\AbstractDBModel;

class DBKonfiguracija extends AbstractDBModel {
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getTable() {
        return 'konfiguracija';
    }
    
    public function getColumns() {
        return array('iznos', 'dan', 'datum');
    }
    
    public function loadOldConfiguration() {
        try{
            $this->load(1);
        } catch(\opp\model\NotFoundException $e) {
            $this->data = null;
        }
    }
    public function insertNewConfiguration() {
        $this->save();
    }
}
