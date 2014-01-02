<?php

namespace view;
use opp\view\AbstractView;

class ObradaZahtjeva extends AbstractView {
    private $zahtjev;
    private $id;
    
    protected function outputHTML() {
?>
    <p><b>Zahtjev: </b></p>
    <p><q><?php echo $this->zahtjev; ?></q></p>
    
    <p><form action="<?php echo \route\Route::get('d3')->generate(array(
        "controller" => "ovlastenaOsobaCtl",
        "action" => "obradiZahtjev"
    ));?>" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $this->id;?>" />
        
        <p>Unesite datum u formatu datum&lt;broj&gt;
        <input type="text" name="datum" />
        </p>
        <p>Unesite dan u formatu dan&lt;brojTjedna&gt;
        <input type="text" name="dan" />
        </p>
        <p>
            <textarea rows="5" cols="100" name="tekst">Upišite odgovor korisniku...</textarea>
        </p>
        <input type="submit" value="Pošalji odgovor" />
    
    </form></p>
    
    <p><b>Ukoliko ste unijeli datum ili dan poruka se automatski briše!</b></p>
    <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
    </p>
<?php
    }
    
    public function setZahtjev($zahtjev) {
        $this->zahtjev = $zahtjev;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }


}
