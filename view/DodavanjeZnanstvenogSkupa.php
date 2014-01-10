<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeZnanstvenogSkupa extends AbstractView{
    private $errorMessage;
    
    protected function outputHTML() {
        
         echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
?>
    
    <form action="<?php echo \route\Route::get("d3")->generate(array(
																	"controller" => "ekspertnaOsobaCtl",
																	"action" => "dodajJavniAlat"
																	));?>" method="POST">

		<div class="form-group">
			<label for="name"><b>Naziv skupa</b></label>
			<input type="text" class="form-control" id="name" placeholder="Upišite naziv skupa" name="naziv" />
		</div>
		<br>
		
        <div class="form-group">
			<label for="mjesto"><b>Mjesto skupa</b></label>
			<input type="text" class="form-control" id="mjesto" placeholder="Upišite mjesto održavanja skupa" name="mjesto" />
		</div>
		<br>
                        
        <div class="form-group">
			<label for="drz"><b>Država skupa</b></label>
			<input type="text" class="form-control" id="drz" placeholder="Upišite ime države u kojoj se odvio skup" name="drzava" />
		</div>
		<br>
            
        <div class="form-group">
            <label for="vrijemep"><b>Dan početka održavanja skupa</b></label>
            <input type="datetime-local" class="form-control" id="vrijemep" name="danPocetka" placeholder="Odaberite dan početka održavanja skupa"/>
		</div>
		<br>
                
        <div class="form-group">
            <label for="vrijemez"><b>Dan završetka održavanja skupa</b></label>
            <input type="datetime-local" class="form-control" id="vrijemez" name="danZavrsetka" placeholder="Odaberite datum završetka znanstvenog skupa" />
		</div>
		<br>
		
        <div class="form-group">
			<label for="adr"><b>Adresa mjesta održavanja skupa</b></label>
			<input type="text" class="form-control" id="adr" placeholder="Upišite adresu mjesta održavanja skupa" name="adresa" />
		</div>
		<br>
        
		<input type="submit" class="btn btn-default" name="submit" value="Dodaj znanstveni skup" /><br>
    </form>
	
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

}     
        

