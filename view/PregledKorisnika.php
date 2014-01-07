<?php

namespace view;
use opp\view\AbstractView;

class PregledKorisnika extends AbstractView {
    private $korisnici;
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if(count($this->korisnici)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Korisnik</b></td><td></td>';
            foreach($this->korisnici as $k) {
                echo "<tr><td>" . $k->username . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayAzuriranjeKorisnika"
                )) . "?id=" . $k->idKorisnika . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan korisnik u sustavu!</b></p>";
        }
        
        ?>
        <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
        <?php
        
    }
    
    public function setKorisnici($korisnici) {
        $this->korisnici = $korisnici;
        return $this;
    }

    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

}