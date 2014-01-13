<?php

namespace view;
use opp\view\AbstractView;

class PrijedlogZaKorekciju extends AbstractView {
    private $poruka;
    private $vrsta;
    private $korisnik;
    private $id;
    
    protected function outputHTML() {
?>
<p>Korisnik predlaže sljedeću izmjenu <?php echo $this->vrsta; ?>:<br />
    <q><?php echo $this->poruka;?></q>
</p>
<form action="<?php echo \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "obradaPrijedloga"
));?>?idK=<?php echo $this->korisnik;?>&id=<?php echo $this->id;?>" method="POST">

    
    <p>
        Pošaljite odgovor korisniku:<br/>
        <textarea name="tekst"></textarea>
    </p>
    <input type="submit" value="Odgovori" />
</form>

<p>
    <b>Napomena:</b> Slanjem odgovora prijedlog se automatski briše!
        
</p>

<a href="<?php echo \route\Route::get("d3")->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "displayPrijedlozi"
));?>">Vrati se na popis prijedloga!</a>

<?php
    }
    
    public function setPoruka($poruka) {
        $this->poruka = $poruka;
        return $this;
    }

    public function setVrsta($vrsta) {
        $this->vrsta = $vrsta;
        return $this;
    }

    public function setKorisnik($korisnik) {
        $this->korisnik = $korisnik;
        return $this;
    }

    public function setId($id) {
        $this->id = $id;
        return $this;
    }


}