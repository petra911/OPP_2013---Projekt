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
    
    public function dohvatiZnanstveneEksperimente(){
        return $this->select()->fetchAll();
    }
    
    /**
     * 
     * @return boolean|string       prosjecna ocjena ili ispis Eksperiment nije ocijenjen | false ako prilikom poziva metode u modelu nije inicijaliziran idEksperimenta
     */
    public function prosjecnaOcjena() {
        if($this->idEksperimenta == null) {
            return false;
        } else {
            $ocjenjuje = new DBOcjenjuje();
            $ocjene = new DBOcjena();
            
            $pov = $ocjenjuje->select()->where(array(
                "idEksperimenta" => $this->getPrimaryKey()
            ))->fetchAll();
            
            if(count($pov)) {
                $sum = 0;
                $count = count($pov);
                foreach($pov as $v) {
                    $ocjene->idOcjene = null;
                    $ocjene->load($v->idOcjene);
                    if($ocjene->ocjena === NULL) {
                        $count = $count - 1;
                    }
                    $sum = $sum + $ocjene->ocjena;
                }
                return ($sum / (float) $count);
            } else {
                return 'Eksperiment nije ocijenjen!';
            }
        }
    }
}