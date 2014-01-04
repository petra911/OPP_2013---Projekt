<?php

namespace model;
use opp\model\AbstractDBModel;

class DBOstvaren extends AbstractDBModel {
    public function getTable() {
        return 'ostvaren';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idAlata', 'idEksperimenta');
    }
    
    public function povezi($id, $idEksperimenta) {
        $pov = $this->select()->where(array(
            "idAlata" => $id,
            "idEksperimenta" => $idEksperimenta
        ))->fetchAll();
        
        if(count($pov)) {
            return;
        } else {
            $this->save();
        }
    }
}