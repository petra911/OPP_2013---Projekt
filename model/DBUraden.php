<?php

namespace model;
use opp\model\AbstractDBModel;

class DBUraden extends AbstractDBModel {
    public function getTable() {
        return 'uraden';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idIDE', 'idEksperimenta');
    }
    
    public function povezi($id, $idEksperimenta) {
        $pov = $this->select()->where(array(
            "idIDE" => $id,
            "idEksperimenta" => $idEksperimenta
        ))->fetchAll();
        
        if(count($pov)) {
            return;
        } else {
            $this->save();
        }
    }
}