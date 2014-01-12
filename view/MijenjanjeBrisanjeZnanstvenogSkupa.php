<?php

namespace view;
use opp\view\AbstractView;

class MijenjanjeBrisanjeZnanstvenogSkupa extends AbstractView {
    private $errorMessage;
    private $skup;
    
    
    protected function outputHTML() {
?>
    <p>
        Podaci o skupu su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "updateZnanstveniSkup"
                                                            ));?>" method="POST">
		<div class="form-group">
			<label for="name"><b>Naziv skupa</b></label>
			<input type="text" class="form-control" id="name" placeholder="Upišite naziv skupa" name="naziv" value="<?php echo __($this->skup->naziv);?>"/>
		</div>
		<br>
		
        <div class="form-group">
			<label for="mjesto"><b>Mjesto skupa</b></label>
			<input type="text" class="form-control" id="mjesto" placeholder="Upišite mjesto održavanja skupa" name="mjesto" value="<?php echo __($this->skup->mjesto);?>"/>
		</div>
		<br>
                        
        <div class="form-group">
			<label for="drz"><b>Država skupa</b></label>
			<input type="text" class="form-control" id="drz" placeholder="Upišite ime države u kojoj se odvio skup" name="drzava" value="<?php echo __($this->skup->drzava);?>"/>
		</div>
		<br>
            
        <div class="form-group">
            <label for="vrijemep"><b>Dan početka održavanja skupa</b></label>
            <input type="datetime-local" class="form-control" id="vrijemep" name="danPocetka" placeholder="Odaberite dan početka održavanja skupa" value="<?php echo __($this->skup->danPocetka);?>"/>
		</div>
		<br>
                
        <div class="form-group">
            <label for="vrijemez"><b>Dan završetka održavanja skupa</b></label>
            <input type="datetime-local" class="form-control" id="vrijemez" name="danZavrsetka" placeholder="Odaberite datum završetka znanstvenog skupa" value="<?php echo __($this->skup->danZavsettka);?>"/>
		</div>
		<br>
		
        <div class="form-group">
			<label for="adr"><b>Adresa mjesta održavanja skupa</b></label>
			<input type="text" class="form-control" id="adr" placeholder="Upišite adresu mjesta održavanja skupa" name="adresa" value="<?php echo __($this->skup->adresa);?>"/>
		</div>
		<br>
		
		
		
        <p>
			<b>Želim izbrisati ovaj skup &nbsp;</b>
			<input type="checkbox" name="checked" value="true" />
        </p>

		
		
			<input type ="hidden" name ="id" value="<?php echo __($this->skup->idSkupa);?>" />

		<br>
        
		<input type="submit" class="btn btn-primary" value="Spremi!" />
    </form>
    
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>
	
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

    public function setSkup($skup) {
        $this->skup = $skup;
        return $this;
    }

}