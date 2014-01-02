<?php

namespace view;
use opp\view\AbstractView;

class ZahtjeviZaPromjenom extends AbstractView {
    /**
     *
     * @var array 
     */
    private $zahtjevi;
    
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    ));
        if(count($this->zahtjevi)) {
            echo "<p><ol>";
            foreach($this->zahtjevi as $v) {
                echo "<p><li><b>" . $v['posiljatelj'] . "</b><br/>" . $v['tekst'] . "<br/><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayObradiZahtjev"
                )) . "?id=" . $v['id']  ."\">Obradi zahtjev</a></li></p>";
            }
            echo "</ol></p>";
        } else {
            echo "<p>Nemate novih zahtjeva!</p>";
        }
?>
        <p>
            <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
        </p>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
    
    public function setZahtjevi($zahtjevi) {
        $this->zahtjevi = $zahtjevi;
        return $this;
    }



}