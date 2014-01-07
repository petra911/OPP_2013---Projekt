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

<div id="myCarousel" class="slide">
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
</div>

	<script src = "./assets/js/jquery.min.js"></script>
	<script src = "./assets/js/bootstrap.js"></script>
	
<div class="navbar navbar-inverse" role="navigation">
      <div class="container">
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
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
		</div><!--/.nav-collapse -->
	  </div>
</div>

<div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec id elit non mi porta gravida at eget metus. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus. Etiam porta sem malesuada magna mollis euismod. Donec sed odio dui. </p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
       </div>
        <div class="col-md-4">
          <h2>Heading</h2>
          <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas eget quam. Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit amet risus.</p>
          <p><a class="btn btn-default" href="#" role="button">View details &raquo;</a></p>
        </div>
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
?>