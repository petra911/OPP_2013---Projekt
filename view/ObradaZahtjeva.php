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
    <br>

    <form action="<?php echo \route\Route::get('d3')->generate(array(
        "controller" => "ovlastenaOsobaCtl",
        "action" => "obradiZahtjev"
    ));?>" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $this->id;?>" />
        
		<div class="form-group">
            <label for="ddatum"><b>Upišite datum</b></label>
            <input type="text" class="form-control" id="ddatum" name="datum" placeholder="Format datuma, npr. datum10 - do 10. u mjesecu" />
		</div>
		<br>

		
		
		<div class="form-group">
            <label for="ddan"><b>Upišite dan</b></label>
            <input type="text" class="form-control" id="ddan" name="dan" placeholder="Format dan, npr. sri2 - do druge srijede u mjesecu" />
		</div>
		<br>
        
		
        <div class="form-group">
			<label><b>Odgovor korisniku</b></label>
            <textarea rows="5" cols="100" class="form-control" name="tekst" placeholder="Upišite odgovor korisniku..."></textarea>
        </div>
		<br>
		
		<input type="submit" class="btn btn-default" value="Pošalji odgovor" />
    
    </form>
    <br>
    <p><b>Ukoliko ste unijeli datum ili dan poruka se automatski briše!</b></p>
	<br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
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
