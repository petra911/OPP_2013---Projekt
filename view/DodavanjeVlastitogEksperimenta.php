<?php

namespace view;
use opp\view\AbstractView;

class DodavanjeVlastitogEksperimenta extends AbstractView {
    private $errorMessage;
    private $platforme;


    protected function outputHTML() {
        echo new components\ErrorMessage(array(
            "errorMessage" => $this->errorMessage
        ));
        
?>
        <form action="<?php echo \route\Route::get('d3')->generate(array(
            "controller" => "korisnik",
            "action" => "dodavanjeVlastitogEksperimenta"
                ));?>" method="POST" enctype="multipart/form-data">
            
			<div class="form-group">
				<label for="eksp"><b>Naziv eksperimenta</b></label>
				<input type="text" class="form-control" id="eksp" placeholder="Upišite naziv eksperimenta" name="naziv" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="poč"><b>Vrijeme početka</b></label>
				<input type="text" class="form-control" id="poč" placeholder="Format dd.mm.yyyy. hh:mm" name="vrijemePocetka" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="end"><b>Vrijeme završetka</b></label>
				<input type="text" class="form-control" id="end" placeholder="Format dd.mm.yyyy. hh:mm" name="vrijemeZavrsetka" />
			</div>
			<br>
			
			<div class="form-group">
            <select name="platforma" class="form-control">
                <option value=""></option>
                <?php if(count($this->platforme)) {
                    foreach($this->platforme as $v) {
                        echo "<option value=\"" . $v->idPlatforme . "\">" . $v->skraceniNaziv . "</option>";
                    }
                }?>
            </select>
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Parametri</b></label>
				<input type="text" class="form-control" id="author" placeholder="Format naziv-ispitniSlucaj;naziv-ispitniSlucaj..." name="parametri" />
			</div>
			<br>
			
			<div class="form-group">
				<label for="jedin"><b>Rezultat</b></label>
				<input type="text" class="form-control" id="author" placeholder="Format: naziv-iznos-mjernaJedinica;naziv-iznos-mjernaJedinica..." name="rezultati" />
			</div>
			<br>
            
			<div class="form-group">
				<label for="jedin"><b>Dodati eksperiment pomoću tekstualne datoteke</b></label>
				<input type="file" class="form-control" id="author" placeholder="Upišite naziv mjerne jedinice rezultata" name="datoteka" />
			</div>
			<br>
            
            <input type="submit" class="btn btn-default" value="Dodaj" />
        </form>
		<br>
        <p>
            <b>Upute:</b><br/>
            Eksperiment možete povezati s alatom i razvojnim okruženjem preko sljedeće poveznice:
            <br/>
            <a href="<?php echo \route\Route::get('d3')->generate(array(
                "controller" => "korisnik",
                "action" => "displayDodavanjeAlataIde"
                ))?>">Klikni me!</a>
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

    public function setPlatforme($platforme) {
        $this->platforme = $platforme;
        return $this;
    }

}