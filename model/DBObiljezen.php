<?php

/**
 * Description of DBObiljezen
 *
 * @author Teach
 */
namespace model;
use opp\model\AbstractDBModel;

class DBObiljezen extends AbstractDBModel{
    //put your code here
    public function getTable() {
        return 'obiljezen';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idTaga', 'idRada');
    }
}
