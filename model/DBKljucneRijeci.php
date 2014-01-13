<?php

namespace model;
use opp\model\AbstractDBModel;

class DBKljucneRijeci extends AbstractDBModel {
    public function getTable() {
        return 'kljucnerijeci';
    }
    
    public function getPrimaryKeyColumn() {
        return 'idTaga';
    }
    
    public function getColumns() {
        return array('tag');
    }
	
    public function dohvatiKljucneRijeci($idTaga) {
        return $this->select()->where(array(
            "idTaga" => $idTaga
        ))->fetchAll();
    }
    
    
    public function dohvatiKljucneRijeciByTag($tag)
    {
        return $this->select()->where(array(
            "tag" => $tag
        ))->fetchAll();
    }
    
      public function dodajKljucnuRijec($tag) {
        $this->idTaga = null;
        $pov = $this->select()->fetchAll();

        if(count($pov)) {
            return $pov[0]->iTaga;
        } else {
            $this->idTaga = null;
            $this->tag=$tag;
            $this->save();
            return $this->getPrimaryKey();
        }
    }
    
}