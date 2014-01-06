<?php

namespace view;
use opp\view\AbstractView;

class Index extends AbstractView {
    /**
     *
     * @var array 
     */
    private $polje;
    
    protected function outputHTML() {
//        session_destroy();
?>
    <hr>
    <div class="container-fluid">
        <div class="row-fluid">
        <div>
        <!--Lijeva rubrika-->
		<ul class="nav nav-pills">
        <?php if(\model\DBKorisnik::isLoggedIn()) echo
            "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                                                                        "controller" => "korisnik",
                                                                        "action" => "logout"
                                                                    )) . "\">Odjavi se</a></li>"
                ; else echo
            "<li><a href=\"" . \route\Route::get('d2')->generate(array(
                                                                        "controller" => "login",
                                                                        "action" => "display"
                                                                    )) . "\">Sign In</a></li>
            <li><a href=\"" . \route\Route::get('d2')->generate(array(
                                                                    "controller" => "register",
                                                                    "action" => "display"
                                                                    )) . "\">Sign Up</a></li>"
                        ;?>
        </ul>
	
		<ul class="nav nav-pills">
            <?php if(isset($_SESSION['vrsta']) && $_SESSION['vrsta'] == 'O') {
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayRegistrations"
                )) . "\">Validacija Novih Korisnika</a></li>";
                 echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayUcitavanjeKonfiguracije"
                )) . "\">Učitavanje Konfiguracije</a></li>";
                 echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayActions"
                )) . "\">Akcije Korisnika</a></li>";
                 echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "\">Zahtjevi Za Promjenom Modela Plaćanja</a></li>";
                 echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayPregledKorisnika"
                )) . "\">Pregled Korisnika</a></li>";
            }
        
            // ako nisi ovlastena osoba
            if(!isset($_SESSION['vrsta']) || (isset($_SESSION['vrsta']) && $_SESSION['vrsta'] != 'O')) {
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "pretrazivanje",
                    "action" => "displayPretrazivanjeRadova"
                )) . "\">Pretraživanje znanstvenih radova</a></li>";                
                
            }
         
            // ako si Ekpertna Osoba ili Registrirani korisnik
            if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' || $_SESSION['vrsta'] == 'E')){
                echo "<li><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "pretrazivanje",
                    "action" => "displayPretrazivanjeEksperimenata"
                )) . "\">Pretraživanje znanstvenih eksperimenata</a></li>";                
                
            }
            
            ?>
		</ul>
        </div><!--
        <div class="jumbotron">
        
            <p>TEST TEST!</p>
            <hr/>
            <?php
            /*if (count($this->polje)) {
                    foreach($this->polje as $s) {
                            echo $s;
                            echo "<br>";
                    }
            }*/
            ?>
        </div>-->
        </div>		

    <div id="myCarousel" class="carousel slide">
        <ol class="carousel-indicators">
            <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>   

        <div class="carousel-inner">
            <div class="item active">
				<img src="./assets/img/pokus.png" alt="Pokus" class = "img-responsive">
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

	<script src = "./assets/js/jquery.min.js"></script>
	<script src = "./assets/js/bootstrap.js"></script>
	

		
    </div>
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


}
