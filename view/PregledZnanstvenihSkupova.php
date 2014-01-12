<?php

namespace view;
use opp\view\AbstractView;

class PregledZnanstvenihSkupova extends AbstractView {
    private $skupovi;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->skupovi)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Znanstveni Skupovi</b></td><td></td>';
            foreach($this->skupovi as $s) {
                echo "<tr><td>" . $s->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenogSkupa"
                )) . "?id=" . $s->idSkupa . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan znanstveni skup u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setSkupovi($skupovi) {
        $this->skupovi = $skupovi;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}