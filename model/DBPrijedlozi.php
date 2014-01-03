<?php

namespace model;
use opp\model\AbstractDBModel;

class DBPrijedlozi extends AbstractDBModel {
    public function getTable() {
        return 'prijedlozi';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idKorisnika', 'idEksperimenta', 'idRada', 'tekst', 'naslov', 'sazetak', 'lokacija', 'autori', 'kljucneRijeci', 'idSkupa', 'idCasopisa');
    }
}
