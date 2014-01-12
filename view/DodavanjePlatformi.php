<?php

namespace view;
use opp\view\AbstractView;

class DodavanjePlatformi extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
        
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
?>
<form action="<?php    echo  \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "dodajPlatformu"
    ));?>" method="POST" enctype="multipart/form-data">
    
        
        <div class="form-group">
				<label for="type"><b>Tip platforme</b></label>
				<input type="text" class="form-control" id="type" placeholder="Upišite tip platforme" name="tip" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="name"><b>Naziv platforme</b></label>
				<input type="text" class="form-control" id="name" placeholder="Upišite naziv platforme" name="naziv" />
			</div>
			<br>
			
        <div class="form-group">
				<label for="sname"><b>Skraćeni naziv platforme</b></label>
				<input type="text" class="form-control" id="sname" placeholder="Upišite skraćeni naziv platforme" name="skraceniNaziv" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="ver"><b>Inačica platforme</b></label>
				<input type="text" class="form-control" id="ver" placeholder="Upišite inačicu platforme" name="inacica" />
			</div>
			<br>
                        
			<label><b>Datasheet platforme</b></label>
				<input type="file" class="btn btn-default" name="datoteka" />
			<br> 
			
            <div class="form-group">
				<label for="pove"><b>Poveznica platforme</b></label>
				<input type="text" class="form-control" id="pove" placeholder="Upišite poveznicu platforme" name="url" />
			</div>
            <br>  

            <div class="form-group">
				<label for="poč"><b>Cijena platforme</b></label>
				<input type="number" min="0" step="0.01" class="form-control" id="price" placeholder="Upišite cijenu platforme" name="cijena" />
			</div>
			<br>
                   
			<input type="submit" class="btn btn-primary" name="submit" value="Dodaj platformu" /><br>
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