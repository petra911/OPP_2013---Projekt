<?php
/**
 * Description of DBJeAutor
 *
 * @author Teach
 */
namespace model;
use opp\model\AbstractDBModel;

class DBJeAutor extends AbstractDBModel{
    //put your code here
    public function getTable() {
        return 'jeautor';
    }
    
    public function getPrimaryKeyColumn() {
        return 'id';
    }
    
    public function getColumns() {
        return array('idRada', 'idAutora');
    }
}
