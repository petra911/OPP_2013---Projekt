<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeUredjaja extends AbstractView{
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
			<label for="karakt"><b>Karakteristike uređaja</b></label>
			<input type="text" class="form-control" id="karakt" placeholder="Upišite karakteristike uređaja" name="karakteristika" />
		</div>
		<br>
		
        <div class="form-group">
			<label for="sname"><b>Skraćeni naziv uređaja</b></label>
			<input type="text" class="form-control" id="sname" placeholder="Upišite skraćeni naziv uređaja" name="skraceninaziv" />
		</div>
        <br>
		
        <div class="form-group">
			<label for="lin"><b>Poveznica za uređaj</b></label>
			<input type="text" class="form-control" id="lin" placeholder="Upišite poveznicu za uređaj" name="link" />
		</div>
		<br> 
                   
		<div class="form-group">
			<label for="data"><b>Datasheet uređaja</b></label>
			<input type="text" class="form-control" id="data" placeholder="Upišite datasheet uređaja" name="datasheet" />
		</div>
		<br>
		
        <div class="form-group">
			<label for="vrsta"><b>Vrsta uređaja</b></label>
			<input type="text" class="form-control" id="vrsta" placeholder="Upišite vrstu uređaja" name="type" />
		</div>
		<br>
                       
		<input type="submit" class="btn btn-default" name="submit" value="Dodaj uređaj" /><br>
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
        

