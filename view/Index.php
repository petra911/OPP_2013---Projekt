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
    <br/>
    <br/>
    <div class="container-fluid">
        <div class="row-fluid">
        <div class="span2" style="background-color:#CCFFFF;">
        <!--Lijeva rubrika-->
        <?php if(\model\DBKorisnik::isLoggedIn()) echo
            "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                                                                        "controller" => "korisnik",
                                                                        "action" => "logout"
                                                                    )) . "\">Odjavi se</a></p>"
                ; else echo
            "<p><a href=\"" . \route\Route::get('d2')->generate(array(
                                                                        "controller" => "login",
                                                                        "action" => "display"
                                                                    )) . "\">Sign In</a></p>
            <p><a href=\"" . \route\Route::get('d2')->generate(array(
                                                                    "controller" => "register",
                                                                    "action" => "display"
                                                                    )) . "\">Sign Up</a></p>"
                        ;?>
        <hr/>
            <?php if(isset($_SESSION['vrsta']) && $_SESSION['vrsta'] == 'O') {
                echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayRegistrations"
                )) . "\">Validacija Novih Korisnika</a></p>";
                 echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayUcitavanjeKonfiguracije"
                )) . "\">Učitavanje Konfiguracije</a></p>";
                 echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayActions"
                )) . "\">Akcije Korisnika</a></p>";
                 echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayZahtjeviZaPromjenom"
                )) . "\">Zahtjevi Za Promjenom Modela Plaćanja</a></p>";
                 echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ovlastenaOsobaCtl",
                    "action" => "displayPregledKorisnika"
                )) . "\">Pregled Korisnika</a></p>";
            }
            
            // ako nisi ovlastena osoba
            if(!isset($_SESSION['vrsta']) || (isset($_SESSION['vrsta']) && $_SESSION['vrsta'] != 'O')) {
                echo "<p><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "pretrazivanje",
                    "action" => "displayPretrazivanjeRadova"
                )) . "\">Pretraživanje znanstvenih radova</a></p>";
            }
            ?>
        </div>
        <div class="span10" style="background-color:#A3FFE0;">
        <!--Tijelo-->
            <p>TEST TEST!</p>
            <hr/>
            <?php
            if (count($this->polje)) {
                    foreach($this->polje as $s) {
                            echo $s;
                            echo "<br>";
                    }
            }
            ?>
        </div>
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
