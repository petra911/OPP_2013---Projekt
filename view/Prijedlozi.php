<?php

namespace view;
use opp\view\AbstractView;

class Prijedlozi extends AbstractView {
    private $poruke;
    
    protected function outputHTML() {
        if (count($this->poruke)) {
            echo '<p><ol>';
            foreach ($this->poruke as $v) {
                echo "<li><q>{$v->tekst}</q><br/><a href=\"" . \route\Route::get("d3")->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPrijedlogZaKorekciju"
                )) . "?id={$v->id}\">Obradi zahtjev</a></li>";
            }
            echo '</ol></p>';
        } else {
            ?>
            <p>Nemate novih prijedloga!</p>
<?php
        }
        
?>
            <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na naslovnicu!</a>         
<?php
    }
    
    public function setPoruke($poruke) {
        $this->poruke = $poruke;
        return $this;
    }



}