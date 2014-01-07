<?php

namespace view;
use opp\view\AbstractView;

class AzuriranjeKorisnika extends AbstractView {
    private $errorMessage;
    private $korisnik;
    
    
    protected function outputHTML() {
?>
    <p>
        Korisnički podaci su navedeni u obrascu. Nakon što unesete željene promjene kliknite na Spremi!
    </p>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
                                                                "controller" => "ovlastenaOsobaCtl",
                                                                "action" => "updateUser"
                                                            ));?>" method="POST">
        <p>Ime:
            <input id = 'ime' type="text" name="ime" value="<?php echo __($this->korisnik->ime);?>"/>
        </p>
        <p>Prezime:
            <input id = 'prez' type="text" name="prez" value="<?php echo __($this->korisnik->prezime);?>"/>
        </p>
        <p>Email:
            <input id = 'mail' type="text" name="mail" value="<?php echo __($this->korisnik->mail);?>"/>
        </p>
        <p>Datum rođenja:
            <input id = 'datum' type="text" name="datum" value="<?php echo __($this->korisnik->datumRod);?>"/>&nbsp;Format YYYY-MM-DD
        </p>
        <p>Korisničko ime:
            <input id = 'username' type="text" name="username" value="<?php echo __($this->korisnik->username);?>"/>
        </p>
        <p>Password:
            <input id = 'pass' type="password" name="pass" />
        </p>
        <p>Validnost:
            <input id = 'validnost' type="text" name="validnost" value="<?php echo __($this->korisnik->validnost);?>"/>&nbsp;0 ili 1
        </p>
        <p>Rok uplate:
            <input id = 'rok' type="text" name="rok" value="<?php echo __($this->korisnik->rokUplate);?>"/>&nbsp;Format datum&lt;broj&gt; ili dan&lt;broj&gt;
        </p>
        <p>Iznos uplate:
            <input id = 'iznos' type="text" name="iznos" value="<?php echo __($this->korisnik->uplata);?>"/>
        </p>
        <p>Vrsta korisnika:
            <input id = 'vrsta' type="text" name="vrsta" value="<?php echo __($this->korisnik->vrsta);?>"/>&nbsp;Moguće vrijednosti: K, E ili O
        </p>
        <p>
            Želim izbrisati ovog korisnika: &nbsp;
            <input type="checkbox" name="checked" value="true" />
        </p>
        <input type ="hidden" name ="id" value="<?php echo __($this->korisnik->idKorisnika);?>" />
        <p>
            <input type="submit" value="Spremi!" />
        </p>
    </form>
    
    <?php echo new components\ErrorMessage(array(
        "errorMessage" => $this->errorMessage
    )); ?>

    <p>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">Vrati se na Naslovnicu</a>
    </p>
<?php
    }
    
    public function setErrorMessage($errorMessage) {
        $this->errorMessage = $errorMessage;
        return $this;
    }

    public function setKorisnik($korisnik) {
        $this->korisnik = $korisnik;
        return $this;
    }

}
