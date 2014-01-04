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
            <p>Unesite naziv:&nbsp;
                <input type="text" name="naziv" />
            </p>
            <p>Unesite skraćeni naziv:&nbsp;
                <input type="text" name="skraceni" />
            </p>
            <p>Unesite inačicu:&nbsp;
                <input type="text" name="inacica" />
            </p>
            <p>Unesite cijenu:&nbsp;
                <input type="text" name="cijena" />
            </p>
            <p>
                <select name="eksperiment">
                    <option value=""></option>
                    <?php if(count($this->eksperimenti)) {
                       foreach($this->eksperimenti as $v) {
                           echo "<option value=\"" . $v->idEksperimenta . "\">" . $v->naziv . "</option>";
                       }
                    }?>
                </select>
            </p>
            
            <p>
                Želim dodati alat: &nbsp;
                <input type="checkbox" name="checked" value="true" />
            </p>
            
            <p>
            <input type="submit" value="Dodaj" />
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

    public function setEksperimenti($eksperimenti) {
        $this->eksperimenti = $eksperimenti;
        return $this;
    }

}