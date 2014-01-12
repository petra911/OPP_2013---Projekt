<?php

namespace view;
use opp\view\AbstractView;

class MijenjanjeBrisanjeJavnogAlata extends AbstractView {
    private $errorMessage;
    private $alat;
    
    
    protected function outputHTML() {
?>
    <p>
        Podaci o alatu su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ekspertnaOsobaCtl",
                                                                "action" => "updateJavniAlat"
                                                            ));?>" method="POST">
		<div class="form-group">
				<label for="jedin"><b>Naziv</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite naziv" name="naziv" value="<?php echo __($this->alat->naziv);?>"/>
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Skraćeni naziv</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite skraćeni naziv" name="skraceniNaziv" value="<?php echo __($this->alat->skraceniNaziv);?>"/>
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Inačicu</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite inačicu" name="inacica" value="<?php echo __($this->alat->inacica);?>"/>
			</div>
			<br>
			
			<div class="form-group">
				<label for="price"><b>Cijena</b></label>
				<input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Upišite cijenu" name="cijena" value="<?php echo __($this->alat->cijena);?>"/>
			</div>
			<br>
	
                        <div class="form-group">
				<label for="jedin"><b>Poveznica</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite poveznicu" name="link" value="<?php echo __($this->alat->link);?>"/>
			</div>
			<br>
		
		
		
        <p>
			<b>Želim izbrisati ovog alata &nbsp;</b>
			<input type="checkbox" name="checked" value="true" />
        </p>

		
		
			<input type ="hidden" name ="id" value="<?php echo __($this->alat->idAlata);?>" />

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

    public function setAlat($alat) {
        $this->alat = $alat;
        return $this;
    }

}