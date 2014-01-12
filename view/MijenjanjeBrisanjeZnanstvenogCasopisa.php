<?php

namespace view;
use opp\view\AbstractView;

class MijenjanjeBrisanjeZnanstvenogCasopisa extends AbstractView {
    private $errorMessage;
    private $casopis;
    
    
    protected function outputHTML() {
?>
    <p>
        Podaci o casopisu su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "updateZnanstveniCasopis"
                                                            ));?>" method="POST">
		<div class="form-group">
			<label for="name"><b>Naziv casopisa</b></label>
			<input type="text" class="form-control" id="name" placeholder="Upišite naziv casopisa" name="naziv" value=" <?php echo __($this->casopis->naziv);?>"/>
		</div>
		<br>
		
        <div class="form-group">
			<label for="mjesto"><b>WWW casopisa</b></label>
			<input type="text" class="form-control" id="mjesto" placeholder="Upišite web adresu casopisa" name="adresa" value= "<?php echo __($this->casopis->adresa);?>"/>
		</div>
		<br>
                
                
                                    
            <div class="form-group">
				<label for="god"><b>Godište časopisa</b></label>
                <input type="number" min="0" class="form-control" id="god" placeholder="Upišite godište časopisa" name="godiste" value= "<?php echo __($this->casopis->godiste);?>"/>
			</div>
			<br>
                        
            <div class="form-group">
				<label for="rbr"><b>Redni broj časopisa</b></label>
				<input type="number" class="form-control" id="rbr" placeholder="Upišite redni broj časopisa" name="rbroj" value= "<?php echo __($this->casopis->redniBroj);?>"/>
			</div>
			<br>
       
		
		
		
        <p>
			<b>Želim izbrisati ovaj casopis &nbsp;</b>
			<input type="checkbox" name="checked" value="true" />
        </p>

		
		
			<input type ="hidden" name ="id" value="<?php echo __($this->casopis->idCasopisa);?>" />

		<br>
        
		<input type="submit" class="btn btn-default" value="Spremi!" />
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

    public function setCasopis($casopis) {
        $this->casopis = $casopis;
        return $this;
    }

}