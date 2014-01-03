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
            <p>
            <textarea name="tekst" rows="5" cols="100">Unesite Vaš prijedlog...</textarea>
            </p>
            <p>
            <input type="submit" value="Pošalji" />
            </p>
        </form>
        </p>
        
        <p>
            <a href="<?php echo \route\Route::get('d2')->generate(array(
                "controller" => "korisnik"
            ));?>">Vrati se u Portfelj</a>
        </p>
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
