<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeSklopovlja extends AbstractView{
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
			<label for="karak"><b>Karakteristike sklopovlja</b></label>
			<input type="text" class="form-control" id="karak" placeholder="Upišite karakteristike sklopovlja" name="karakteristika" />
		</div>
		<br>
			
        <div class="form-group">
				<label for="sname"><b>Skraćeni naziv sklopovlja</b></label>
				<input type="text" class="form-control" id="sname" placeholder="Upišite skraćeni naziv sklopovlja" name="skraceninaziv" />
		</div>
		<br>
        
		<input type="submit" class="btn btn-default" name="submit" value="Dodaj sklopovlje" /><br>
                        
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
        

