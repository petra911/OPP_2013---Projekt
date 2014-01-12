<?php

namespace view;
use opp\view\AbstractView;

class PregledSklopovlja extends AbstractView {
    private $sklopovlja;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->sklopovlja)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Sklopovlje</b></td><td></td>';
            foreach($this->sklopovlja as $s) {
                echo "<tr><td>" . $s->skraceniNaziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeSklopovlja"
                )) . "?id=" . $s->idSklopovlja . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedno sklopovlje u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setSklopovlja($sklopovlja) {
        $this->sklopovlja = $sklopovlja;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}