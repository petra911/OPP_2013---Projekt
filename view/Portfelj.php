<?php

namespace view;
use opp\view\AbstractView;

class Portfelj extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
?>
    <br/>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span2" style="background-color:#CCFFFF;">
        <!--Lijeva rubrika-->
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                        "controller" => "korisnik",
                                                                        "action" => "logout"
                                                                    )); ?>">Odjavi se</a></p>
            <hr />
            <?php echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "pretrazivanje",
                    "action" => "displayPretrazivanjeRadova"
                )) . "\">Pretraživanje znanstvenih radova</a></p>";?>
            
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPromjenaModela"
                                                                    )); ?>">Promjena Modela Plaćanja</a></p>
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPoruke"
                                                                    )); ?>">Inbox</a></p>
            
        </div>
        <div class="span10" style="background-color:#A3FFE0;">
        <!--Tijelo-->
            <p>Portfelj</p>
            <?php echo new components\ErrorMessage(array(
                "errorMessage" => $this->errorMessage
            )); ?>
            <hr/>
            
        </div>
        </div>
    </div>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
    
}
