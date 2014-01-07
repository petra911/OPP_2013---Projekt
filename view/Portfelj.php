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
</div>
<div id='cssmenu'>
<ul>
   <li class='has-sub'><a><span>Pretraživanje</span></a>
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
  
   <li class='has-sub'><a><span>Dodavanje</span></a>
      <ul>
         <li><a href="<?php echo \route\Route::get('d3')->generate(array(
																		"controller" => "korisnik",
																		"action" => "displayPredlaganjeNovogRada"
																		)); ?>">Predloži Dodavanje Novog Rada</a></li>
         <li><a href="<?php echo \route\Route::get('d3')->generate(array(
																		"controller" => "korisnik",
																		"action" => "displayDodavanjeAlataIde"
																		)); ?>">Dodavanje Alata i Razvojnih Okruženja</a></li>
         <li class='last'><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayDodavanjeVlastitogEksperimenta"
                                                                    )); ?>">Dodavanje Vlastitog Eksperimenta</a>
      </ul>
   </li>
   <li><a href="<?php echo \route\Route::get('d3')->generate(array(
                                                                    "controller" => "korisnik",
                                                                    "action" => "displayPromjenaModela"
                                                                    )); ?>">Promjena Modela Plaćanja</a></li>
   <li class='last'><a href="<?php echo \route\Route::get('d3')->generate(array(
																				"controller" => "korisnik",
																				"action" => "displayPoruke"
																				)); ?>">Inbox</a></a></li>
</ul>

<!--
<div class="navbar navbar-inverse col-md-9" role="navigation">

    <p style="color:#FFFFFF; font-size:24px;">Portfelj</p>
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
    -->

</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
</br>
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
