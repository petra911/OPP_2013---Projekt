<?php

namespace view;
use opp\view\AbstractView;

class ZahtjeviZaPromjenom extends AbstractView {
    /**
     *
     * @var array 
     */
    private $zahtjevi;
    
    private $errorMessage;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    ));
        if(count($this->zahtjevi)) {
            echo '<table class="table table-bordered table-hover">
			<td><b>Korisnik</b></td><td><b>Poruka</b></td><td><b></b></td>';
            foreach($this->zahtjevi as $v) {
                echo "<tr><td>" . $v['posiljatelj'] . "</td><td>" . $v['tekst'] . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayObradiZahtjev"
                )) . "?id=" . $v['id']  ."\">Obradi zahtjev</a></td>";
            }
            echo "</table>";
        } else {
            echo "<p>Nemate novih zahtjeva!</p>";
        }
?>
    <br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
    
    public function setZahtjevi($zahtjevi) {
        $this->zahtjevi = $zahtjevi;
        return $this;
    }



}