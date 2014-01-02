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
            echo "<p><ol>";
            foreach($this->korisnici as $k) {
                echo "<p><li>" . $k->username . "<br/><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayAzuriranjeKorisnika"
                )) . "?id=" . $k->idKorisnika . "\">Ažuriraj podatke</a></li></p>";
            }
            echo "</ol></p>";
        } else {
            echo "<p><b>Ne postoji niti jedan korisnik u sustavu!</b></p>";
        }
        
        ?>
        <p>
            <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
        </p>
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