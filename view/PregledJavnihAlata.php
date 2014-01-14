<?php

namespace view;
use opp\view\AbstractView;

class PregledJavnihAlata extends AbstractView
{
    private $alati;
    private $errorMessage;
    
    protected function outputHTML()
    {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
        if (count($this->alati)) {
            echo '<table class="table table-bordered table-hover">
            <td><b>Javni alati:</b></td><td></td>';
            foreach ($this->alati as $a) {
                echo "<tr><td>" . $a->naziv . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayMijenjanjeBrisanjeJavnogAlata"
                )) . "?id=" . $a->idAlata . "\">Ažuriraj podatke</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p><b>Ne postoji niti jedan javni alat u sustavu!</b></p>";
        }
        
?>
       <br><br>
    <a href="<?php
        echo \route\Route::get('d1')->generate();
?>">
        <img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
    </a>
        <?php
        
    }
    
    public function setAlati($alati)
    {
        $this->alati = $alati;
        return $this;
    }
    
    public function setErrorMessage($errorMessage)
    {
        $this->errorMessage = $errorMessage;
        return $this;
    }
    
}
