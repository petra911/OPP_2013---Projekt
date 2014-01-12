<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeJavnogAlata extends AbstractView {
    private $errorMessage;
    
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
?>
        <p>
        <form action="<?php echo \route\Route::get("d3")->generate(array(
            "controller" => "ekspertnaOsobaCtl",
            "action" => "dodajJavniAlat"
                ));?>" method="POST">
				
			<div class="form-group">
				<label for="jedin"><b>Naziv</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite naziv" name="naziv" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Skraćeni naziv</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite skraćeni naziv" name="skraceni" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Inačicu</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite inačicu" name="inacica" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="price"><b>Cijena</b></label>
				<input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Upišite cijenu" name="cijena" />
			</div>
			<br>
	
                        <div class="form-group">
				<label for="jedin"><b>Poveznica</b></label>
				<input type="text" class="form-control" id="author" placeholder="Upišite poveznicu" name="link" />
			</div>
			<br>
            
            <br>
            <input type="submit" class="btn btn-default"  value="Dodaj" />

        </form>
        </p>
        
        <br><br>
		<a href="<?php echo \route\Route::get('d2')->generate(array(
																"controller" => "korisnik"
																));?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se u portfelj" height="50" />
    </a>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }


}