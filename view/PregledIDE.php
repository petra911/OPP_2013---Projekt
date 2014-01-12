<?php

namespace view;
use opp\view\AbstractView;

class PregledIDE extends AbstractView {
    private $IDEi;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->IDEi)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>IDE</b></td><td></td>';
            foreach($this->IDEi as $i) {
                echo "<tr><td>" . $i->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeIDE"
                )) . "?id=" . $i->idIDE . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan IDE u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setIDEi($IDEi) {
        $this->IDEi = $IDEi;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}