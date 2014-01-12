<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeZnanstvenogCasopisa extends AbstractView{
    private $errorMessage;
    
    protected function outputHTML() {
        
         echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
?>
    

    <form action="<?php echo \route\Route::get("d3")->generate(array(
            "controller" => "ekspertnaOsobaCtl",
            "action" => "dodajZnanstveniCasopis"
                ));?>" method="POST">
    
			
			<div class="form-group">
				<label for="naz"><b>Naziv časopisa</b></label>
				<input type="text" class="form-control" id="naz" placeholder="Upišite naziv časopisa" name="name" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="adr"><b>Adresa časopisa</b></label>
				<input type="text" class="form-control" id="adr" placeholder="Upišite adresu časopisa" name="adress" />
			</div>
			<br>
                        
            <div class="form-group">
				<label for="god"><b>Godište časopisa</b></label>
                <input type="number" min="0" class="form-control" id="god" placeholder="Upišite godište časopisa" name="godiste" />
			</div>
			<br>
                        
            <div class="form-group">
				<label for="rbr"><b>Redni broj časopisa</b></label>
				<input type="number" class="form-control" id="rbr" placeholder="Upišite redni broj časopisa" name="rbroj" />
			</div>
			<br>
          
            <input type="submit" class="btn btn-primary" name="submit" value="Dodaj znanstveni časopis" /><br>
 
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