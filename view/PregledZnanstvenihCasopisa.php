<?php

namespace view;
use opp\view\AbstractView;

class PregledZnanstvenihCasopisa extends AbstractView {
    private $casopisi;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->casopisi)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Znanstveni Casopisi</b></td><td></td>';
            foreach($this->casopisi as $c) {
                echo "<tr><td>" . $c->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeZnanstvenogCasopisa"
                )) . "?id=" . $c->idCasopisa . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan znanstveni casopis u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setCasopisi($casopisi) {
        $this->casopisi = $casopisi;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}