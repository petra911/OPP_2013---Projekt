<?php

namespace view;
use opp\view\AbstractView;

class PregledPlatformi extends AbstractView {
    private $platforme;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->platforme)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Platforme</b></td><td></td>';
            foreach($this->platforme as $p) {
                echo "<tr><td>" . $p->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjePlatforme"
                )) . "?id=" . $p->idPlatforme . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedna platforma u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setPlatforme($platforme) {
        $this->platforme = $platforme;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}