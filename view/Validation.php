<?php

namespace view;
use opp\view\AbstractView;

class Validation extends AbstractView {
    private $list;
    
    protected function outputHTML() {
        if(count($this->list)) {
        echo "<ol>";
        foreach($this->list as $v) {
            echo "<li><p>", $v->username, '<br>', "<a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "validate"
            )) . "?id=" . $v->idKorisnika . "\">Validiraj</a></p></li>";
        }
        echo "</ol>";
        } else {
            echo "Nema novih zahtjeva za registracijom!";
        }
        ?>
         
        <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
        </p>
<?php
    }
    
    public function setList($list) {
        $this->list = $list;
        return $this;
    }

}