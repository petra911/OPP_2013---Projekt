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
    
    public function dohvatiInterneEksperimente ($idKorisnika) {
        $portfelj = new DBPortfelj();
        $pov = $this->select()->fetchAll();
        
        if (count($pov)) {
            $povrat = array();
            $i = 0;
            foreach ($pov as $v) {
                if ($v->vidljivost == 'I' && $portfelj->postojiZapis($idKorisnika, $v->idEksperimenta, null)) {
                   $povrat[$i] = $v;
                   $i = $i + 1;
                }
            }
            return $povrat;
        } else {
            return array();
        }
    }
}