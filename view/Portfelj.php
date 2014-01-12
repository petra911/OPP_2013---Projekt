<?php

namespace view;
use opp\view\AbstractView;

class Portfelj extends AbstractView {
    private $errorMessage;
    private $zapisi;
    
    protected function outputHTML() {
?>
<div style="padding-left:30px;">
	<img src="./assets/img/portfolio.jpg" alt="Pokus" class = "img-responsive"></div>
</div>

<div id='cssmenu'>
<ul>
   	<li class='has-sub'><a>Pretraživanje</a>
      <ul>
      	<li><?php echo "<a href=\"" . \route\Route::get('d3')->generate(array(
																				"controller" => "pretrazivanje",
																				"action" => "displayPretrazivanjeRadova"
																			)) . "\">Pretraživanje znanstvenih radova</a>";?></li>
         <li class='last'><?php echo "<a href=\"" . \route\Route::get('d3')->generate(array(
																							"controller" => "pretrazivanje",
																							"action" => "displayPretrazivanjeEksperimenata"
																						)) . "\">Pretraživanje znanstvenih eksperimenata</a>"; ?>        </li>  
	 </ul>
   <li class='has-sub'><a>Dodavanje</a>
      <ul>
         <li><a href="<?php echo \route\Route::get('d3')->generate(array(
																		"controller" => "korisnik",
																		"action" => "displayPredlaganjeNovogRada"
																		)); ?>">Predloži dodavanje novog rada</a></li>
         <li><a href="<?php echo \route\Route::get('d3')->generate(array(
																		"controller" => "korisnik",
																		"action" => "displayDodavanjeAlataIde"
																		)); ?>">Dodavanje alata i razvojnih okruženja</a></li>
         <li class='last'><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayDodavanjeVlastitogEksperimenta"
                                                                    )); ?>">Dodavanje vlastitog eksperimenta</a>
      </ul>
   </li>
   <li><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPromjenaModela"
                                                                    )); ?>">Promjena modela plaćanja</a></li>
   <li class='last'><a href="<?php echo \route\Route::get('d3')->generate(array(
																				"controller" => "korisnik",
																				"action" => "displayPoruke"
																				)); ?>">Poruke</a></li>

</ul>
</div>

<div class="main">
	<h1><span>Radovi i eksperimenti</span></h1>
    <div class = "container-narrow">
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
    </div>
    
    <hr/>
    
    <div class="container-narrow">
		<h4><?php if(count($this->zapisi)) {
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
        ?></h4>
    </div>
</div>

</br>
</br>
</br>
</br>

    
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
