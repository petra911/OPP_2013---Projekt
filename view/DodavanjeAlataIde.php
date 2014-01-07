<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeAlataIde extends AbstractView {
    private $errorMessage;
    
    private $eksperimenti;
    
    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
?>
        <p>
        <form action="<?php echo \route\Route::get("d3")->generate(array(
            "controller" => "korisnik",
            "action" => "dodajAlatIde"
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
				<input type="text" class="form-control" id="price" placeholder="Upišite cijenu" name="cijena" />
			</div>
			<br>
			
            <div class="form-group">
                <select name="eksperiment" class="form-control">
                    <option value=""></option>
                    <?php if(count($this->eksperimenti)) {
                       foreach($this->eksperimenti as $v) {
                           echo "<option value=\"" . $v->idEksperimenta . "\">" . $v->naziv . "</option>";
                       }
                    }?>
                </select>
            </div>
            
            <p>
                Želim dodati alat
                <input type="checkbox" name="checked" value="true" />
            </p>
            <br>
            <input type="submit" class="btn btn-default"  value="Dodaj" />

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

    public function setEksperimenti($eksperimenti) {
        $this->eksperimenti = $eksperimenti;
        return $this;
    }

}