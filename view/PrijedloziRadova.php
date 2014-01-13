<?php

namespace view;
use opp\view\AbstractView;

class PrijedloziRadova extends AbstractView {
    private $prijedlozi;
    
    protected function outputHTML() {
        if (count($this->prijedlozi)) {
            echo "<p><ol>";
            foreach ($this->prijedlozi as $v) {
                echo "<p><li>" . $v->naslov . "<br/><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPrijedlogRada"
                )) ."?id=" . $v->id . "\">Obradi prijedlog</a></li></p>";
            }
            echo "</ol></p>";
            
        } else {
            echo "<p>Ne postoje novi prijedlozi!</p>";
        }
?>
<p><a href="<?php echo \route\Route::get("d1")->generate();?>">Vrati se na naslovnicu!</a></p>
<?php
    }
    
    public function setPrijedlozi($prijedlozi) {
        $this->prijedlozi = $prijedlozi;
        return $this;
    }


}