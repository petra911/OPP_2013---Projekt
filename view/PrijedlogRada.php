<?php

namespace view;
use opp\view\AbstractView;

class PrijedlogRada extends AbstractView {
    private $prijedlog;
    private $imeSkupa;
    private $imeCasopisa;
    
    protected function outputHTML() {
?>
<p>
    Korisnik je predložio unos sljedećih podataka:
    
    <p>Naslov: <?php echo __($this->prijedlog->naslov);?></p>
    <p>Autori: <?php echo __($this->prijedlog->autori);?></p>
    <p>Sažetak: <br/><q><?php echo __($this->prijedlog->sazetak);?></q></p>
    <p>Ključne riječi: <?php echo __($this->prijedlog->kljucneRijeci);?></p>
    
    <p>Znanstveni rad mozete pogledati ovdje:<br/><a href="<?php echo \route\Route::get('d3')->generate(array(
        "controller" => "ekspertnaOsobaCtl",
        "action" => "displayPDFRada"
    )) . "?id=" . $this->prijedlog->id;?>">Klikni me!</a></p>
    
    <?php if($this->prijedlog->tekst == NULL) {
        if($this->imeSkupa != NULL) {
            echo "<p>Znanstveni skup: " . $this->imeSkupa . "</p>";
        } else if ($this->imeCasopisa != NULL) {
            echo "<p>Znanstveni časopis: " . $this->imeCasopisa . "</p>";
        }
    } else {
       echo "<p>Znanstveni Rad i Skup: <br/><q>" . $this->prijedlog->tekst . "</q></p>"; 
    }?>
    
</p>
<p>
<form action="<?php echo \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "obradiPrijedlogRada"
)) . "?idK=" . $this->prijedlog->idKorisnika . "&id=" . $this->prijedlog->id;?>" method="post">
    <p>
        Ogovorite korisniku:
        <br/>
        <textarea name="tekst"></textarea>
    </p>
    
    <p>
        <input type="submit" value="Odgovori"/>
    </p>
</form>
</p>

<p>
    <b>Slanjem poruke prijedlog se automatski brise!</b>
</p>

<p><a href="<?php echo \route\Route::get("d3")->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "displayPrijedloziRadova"
));?>">Vrati se na popis prijedloga!</a></p>
<?php
    }
    
    public function setPrijedlog($prijedlog) {
        $this->prijedlog = $prijedlog;
        return $this;
    }
    
    public function setImeSkupa($imeSkupa) {
        $this->imeSkupa = $imeSkupa;
        return $this;
    }

    public function setImeCasopisa($imeCasopisa) {
        $this->imeCasopisa = $imeCasopisa;
        return $this;
    }




}