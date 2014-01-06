<?php

namespace view;
use opp\view\AbstractView;

class PretrazivanjeRadova extends AbstractView {
    private $errorMessage;
    
    protected function outputHTML() {
?>
	<hr>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                    "controller" => "pretrazivanje",
                                                    "action" => "pretraziRadove"
                                                ));?>" method="POST" >
		<div class="form-group">
            <label for="prezime"><b>Prezime autora</b></label>
            <input type="text" class="form-control"prezime" name="autor" placeholder="Upišite prezime autora" />
		</div>
		<br>
  
		<div class="form-group">
            <label for="nasslov"><b>Naslov</b></label>
            <input type="text" class="form-control" id="nasslov" name="naslov" placeholder="Upišite naslov" />
		</div>
		<br>

		<div class="form-group">
            <label for="ključna"><b>Ključne riječi</b></label>
            <input type="text" class="form-control" id="ključna" name="keyword" placeholder="Upišite ključne riječi" />
		</div>
		<br>


        <p>
            <b>Napomena:</b> Ukoliko zelite pretragu vršiti po više parametara, odvojite ih sa znakom zarez (,)!
        </p>
        <input type="submit" class="btn btn-default" name="submit" value="Traži" />
		<br><br><br>
    </form>

    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>

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
