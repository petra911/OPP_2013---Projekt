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
            <p>Unesite naziv eksperimenta: &nbsp;
                <input type="text" name="naziv" />
            </p>
            <p>Unesite vrijeme pocetka: (format dd.mm.yyyy. hh:mm) <br/>
                <input type="text" name="vrijemePocetka" />
            </p>
            <p>Unesite vrijeme završetka: (format dd.mm.yyyy. hh:mm) <br/>
                <input type="text" name="vrijemeZavrsetka" />
            </p>
            <p>
            <select name="platforma">
                <option value=""></option>
                <?php if(count($this->platforme)) {
                    foreach($this->platforme as $v) {
                        echo "<option value=\"" . $v->idPlatforme . "\">" . $v->skraceniNaziv . "</option>";
                    }
                }?>
            </select>
            </p>
            <p>Unesite parametre u formatu naziv-ispitniSlucaj;naziv-ispitniSlucaj....<br/>
                <input type="text" name="parametri" />
            </p>
            <p>Unesite rezultate u formatu naziv-iznos-mjernaJedinica;naziv-iznos-mjernaJedinica....<br/>
                <input type="text" name="rezultati" />
            </p>
            
            <p>Ukoliko želite dodati eksperiment pomoću tekstualne datoteke, to možete učiniti u sljedećem polju:&nbsp;
                <input type="file" name="datoteka" />
            </p>
            
            <input type="submit" value="Dodaj" />
        </form>

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