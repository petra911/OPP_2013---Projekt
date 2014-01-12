<?php

namespace view;
use opp\view\AbstractView;

class PredlaganjeKorekcije extends AbstractView {
    private $errorMessage;
    private $id;
    private $v;
    
    protected function outputHTML() {
?>
        
<p>
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    ));?>
</p>
        <p>
            
        <form action="<?php echo \route\Route::get('d3')->generate(array(
            "controller" => "korisnik",
            "action" => "predloziKorekciju"
            ));?>" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $this->id;?>" />
            <input type="hidden" name="v" value="<?php echo $this->v?>" />
            <div class="form-group-textarea">
				<label><b>Vaš prijedlog</b></label>
				<textarea rows="5" class="form-control" cols ="100" name="tekst" placeholder="Upišite Vaš prijedlog"></textarea>
			</div>
			<br>
            <p>
            <input type="submit" class="btn btn-default" value="Pošalji" />
            </p>
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

    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    
    public function setV($v) {
        $this->v = $v;
        return $this;
    }

}
