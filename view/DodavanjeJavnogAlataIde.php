<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeJavnogAlataIde extends AbstractView {
    private $errorMessage;
    
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
?>

        <form action="<?php echo \route\Route::get("d3")->generate(array(
																		"controller" => "ekspertnaOsobaCtl",
																		"action" => "dodajJavniAlatIde"
																			));?>" method="POST">

			<div class="form-group">
				<label for="ime"><b>Naziv</b></label>
				<input type="text" class="form-control" id="ime" placeholder="Upišite naziv" name="naziv" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="sname"><b>Skraćeni naziv</b></label>
				<input type="text" class="form-control" id="sname" placeholder="Upišite skraćeni naziv" name="skraceni" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="inač"><b>Inačicu</b></label>
				<input type="text" class="form-control" id="inač" placeholder="Upišite inačicu" name="inacica" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="price"><b>Cijena</b></label>
				<input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Upišite cijenu" name="cijena" />
			</div>
			<br>
            
            Želim dodati alat
            <input type="checkbox" name="checked" value="true" />
			<br>
            <br>
            <input type="submit" class="btn btn-default"  value="Dodaj" />
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