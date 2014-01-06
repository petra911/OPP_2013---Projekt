<?php

namespace view;
use opp\view\AbstractView;

class Portfelj extends AbstractView {
    private $errorMessage;
    private $zapisi;
    
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
            <p><?php echo "<a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "pretrazivanje",
                    "action" => "displayPretrazivanjeEksperimenata"
                )) . "\">Pretraživanje znanstvenih eksperimenata</a>"; ?> </p>
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPredlaganjeNovogRada"
                                                                    )); ?>">Predloži Dodavanje Novog Rada</a></p>
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPromjenaModela"
                                                                    )); ?>">Promjena Modela Plaćanja</a></p>
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayDodavanjeAlataIde"
                                                                    )); ?>">Dodavanje Alata i Razvojnih Okruženja</a></p>
            <p><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayDodavanjeVlastitogEksperimenta"
                                                                    )); ?>">Dodavanje Vlastitog Eksperimenta</a></p>
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
            <?php if(count($this->zapisi)) {
                echo "<p class=\"text-left\"><ol>";
                foreach($this->zapisi as $v) {
                    if($v['idRada'] != null) {
                        echo "<li>" . $v['nazivRada'] . "&nbsp;&nbsp;&nbsp;<a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "brisiRad"
                        )) ."?id=" . $v["idRada"] . "\">Briši</a></li>";
                    } else {
                        echo "<li>" . $v['nazivEksperimenta'] . "&nbsp;&nbsp;&nbsp;<a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "brisiEksperiment"
                        )) ."?id=" . $v["idEksperimenta"] ."\">Briši</a></li>";
                    }
                }
                echo "</ol></p>";
            }    
            ?>
        </div>
        </div>
    </div>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
    
    public function setZapisi($zapisi) {
        $this->zapisi = $zapisi;
        return $this;
    }
    
}
