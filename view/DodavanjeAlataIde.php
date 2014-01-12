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
            <label for="naz"><b>Naziv</b></label>
            <input type="text" class="form-control" name="naziv" placeholder="Upišite naziv"/>
         </div>
         <br />
         
         <div class="form-group">
            <label for="skraceni"><b>Skraćeni naziv</b></label>
            <input type="text" class="form-control" name="skraceni" placeholder="Upišite skraćeni naziv"/>
         </div>
         <br />
         
         <div class="form-group">
            <label for="ver"><b>Inačica</b></label>
            <input type="text" class="form-control" name="inacica" placeholder="Upišite inačicu"/>
         </div>
         <br />
         
         <div class="form-group">
            <label for="cijena"><b>Cijena</b></label>
            <input type="text" class="form-control" name="cijena" placeholder="Upišite cijenu"/>
         </div>
         <br />
            
         <div class="form-group">
			<label for="eksp"><b>Izaberite eksperiment</b></label>
                <select name="eksperiment" class="form-control">
                    <option value=""></option>
                    <?php if(count($this->eksperimenti)) {
                       foreach($this->eksperimenti as $v) {
                           echo "<option value=\"" . $v->idEksperimenta . "\">" . $v->naziv . "</option>";
                       }
                    }?>
                </select>
         </div>
         <br />
            
         <p>
             <b>Želim dodati alat: &nbsp;</b>
             <input type="checkbox" name="checked" value="true" />
         </p>
            
        <input type="submit" class="btn btn-primary" value="Dodaj" />
        </form>
        
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

    public function setEksperimenti($eksperimenti) {
        $this->eksperimenti = $eksperimenti;
        return $this;
    }

}