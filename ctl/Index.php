<?php

namespace ctl;
use opp\controller\Controller;

class Index implements Controller {
    
    public function display() {
        
        echo new \view\Main(array(
            "body" => new \view\Index(array(
                "polje" => array(1,2,3,4,5,6)
            )),
            "title" => "OPP TEST"
        ));
    }
}