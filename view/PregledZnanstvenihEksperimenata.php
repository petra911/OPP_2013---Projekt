<?php

namespace view;
use opp\view\AbstractView;

class PregledZnanstvenihEksperimenata extends AbstractView {
    private $eksperimenti;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->eksperimenti)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Znanstveni Eksperimenti</b></td><td></td>';
            foreach($this->eksperimenti as $c) {
                echo "<tr><td>" . $c->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenogEksperimenta"
                )) . "?id=" . $c->idEksperimenta . "\">Ažuriraj podatke</a></td>";
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
    
    public function setEksperimenti($eksperimenti) {
        $this->eksperimenti = $eksperimenti;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}