<?php

namespace view;
use opp\view\AbstractView;

class Index extends AbstractView {
    /**
     *
     * @var array 
     */
    private $polje;
    
    private $errorMessage;
    
    protected function outputHTML() {
//        session_destroy();
?>
<?php if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K')){
 preusmjeri(\route\Route::get('d2')->generate(array(
     "controller" => "korisnik"
 )));
}?>
<div id="myCarousel" class="slide">
    <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
    </ol>   

    <div class="carousel-inner">
        <div class="item active">
            <img src="./assets/img/pokus.jpg" alt="Pokus" class = "img-responsive">
        </div>
        <div class="item">
            <img src="./assets/img/društvo.jpeg" alt="Društvo" class = "img-responsive">
        </div>
        <div class="item">
            <img src="./assets/img/knjiga.jpg" alt="Knjiga" class = "img-responsive">
        </div>
    </div>

    <a class="carousel-control left" href="#myCarousel" data-slide="prev">
        <span class = "icon-prev"></span>
    </a>
    <a class="carousel-control right" href="#myCarousel" data-slide="next">
        <span class = "icon-next"></span>
    </a>
</div>
</div>

	<script src = "./assets/js/jquery.min.js"></script>
	<script src = "./assets/js/bootstrap.js"></script>
	
<div id='cssmenu'>
  <ul>
          <?php if(isset($_SESSION['vrsta']) && $_SESSION['vrsta'] == 'O') {
            echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayRegistrations"
            )) . "\">Validacija novih korisnika</a></li>";
             echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayUcitavanjeKonfiguracije"
            )) . "\">Učitavanje konfiguracije</a></li>";
             echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayActions"
            )) . "\">Akcije korisnika</a></li>";
             echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayZahtjeviZaPromjenom"
            )) . "\">Zahtjevi za promjenom modela plaćanja</a></li>";
             echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                "controller" => "ovlastenaOsobaCtl",
                "action" => "displayPregledKorisnika"
            )) . "\">Pregled korisnika</a></li>";
		  }
			?>
			
			<?php if(!isset($_SESSION['vrsta']) || (isset($_SESSION['vrsta']) && $_SESSION['vrsta'] != 'O')) {
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
					"controller" => "pretrazivanje",
					"action" => "displayPretrazivanjeRadova"
				)) . "\">Pretraživanje znanstvenih radova</a></li>";                
				
			}
			?>
			
			<?php if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' || $_SESSION['vrsta'] == 'E')){
                            
                            
                
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeJavnogEksperimenta"
                )) . "\"> Dodavanje javnog znanstvenog eksperimenta</a></li>";
                            
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
					"controller" => "pretrazivanje",
					"action" => "displayPretrazivanjeEksperimenata"
				)) . "\">Pretraživanje znanstvenih eksperimenata</a></li>";    
                                         
				
			}
             ?>

      <?php if (isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'E')) {
		echo "<li class='has-sub'><a>Dodavanje</a>
		<ul>
			<li>";?><?php if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'E')){

                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeJavnogAlata"
                )) . "\"> Dodavanje alata</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeIDE"
                )) . "\"> Dodavanje IDE</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjePlatformi"
                )) . "\"> Dodavanje platforme</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeSklopovlja"
                )) . "\"> Dodavanje sklopovlja</a></li>";
                            
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeUredjaja"
                )) . "\"> Dodavanje uređaja</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeZnanstvenogCasopisa"
                )) . "\"> Dodavanje znanstvenog časopisa</a></li>";
                            
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayDodavanjeZnanstvenogSkupa"
                )) . "\"> Dodavanje znanstvenog skupa</a></li>";
            }
			?><?php echo "</li></ul></li>
			
			
		<li class='has-sub'><a>Mijenjanje/brisanje</a>
			<ul>
			<li>";?><?php if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'E')){
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledIDE"
                )) . "\"> Mijenjanje/brisanje IDE</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledJavnihAlata"
                )) . "\"> Mijenjanje/brisanje javnih alata</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledPlatformi"
                )) . "\"> Mijenjanje/brisanje platformi</a></li>";
            
                
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledSklopovlja"
                )) . "\"> Mijenjanje/brisanje sklopovlja</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledZnanstvenihCasopisa"
                )) . "\"> Mijenjanje/brisanje znanstvenih časopisa</a></li>";
				
				echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" =>  "ekspertnaOsobaCtl",
                    "action" =>"displayPregledZnanstvenihSkupova"
                )) . "\"> Mijenjanje/brisanje znanstvenih skupova</a></li>";
			}
			?><?php echo "</li></ul></li>";

                }?>
  </ul>
</div>

<div class="main">
    <div class = "container-narrow">
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
    </div>
</div>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>


<?php
    }
    
    /**
     * 
     * @param array $poljeID
     * @return \templates\Index
     */
    public function setPolje(array $poljeID = array()) {
        $this->polje = $poljeID;
        return $this;
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }
}
?>