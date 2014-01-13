<?php

namespace view;
use opp\view\AbstractView;

class PregledZnanstvenihRadova extends AbstractView {
    private $radovi;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->radovi)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Znanstveni Radovi</b></td><td></td>';
            foreach($this->radovi as $c) {
                echo "<tr><td>" . $c->naslov . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenogRada"
                )) . "?id=" . $c->idRada . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan znanstveni eksperiment u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setRadovi($radovi) {
        $this->radovi = $radovi;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}