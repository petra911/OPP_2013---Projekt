<?php

namespace view;
use opp\view\AbstractView;

class Ocjenjivanje extends AbstractView {
    private $id;
    
    protected function outputHTML() {
?>
    <form action="<?php echo \route\Route::get('d3')->generate(array(
        "controller" => "korisnik",
        "action" => "ocijeni"
    )); ?>" method="POST">
        
        <input type="hidden" name="id" value="<?php echo $this->id;?>" />
        
        <p>
            Odaberite ocjenu:
            <select name="ocjena">
                <option value=""></option>
                <option value="1">1</option>
                <option value="1.5">1.5</option>
                <option value="2">2</option>
                <option value="2.5">2.5</option>
                <option value="3">3</option>
                <option value="3.5">3.5</option>
                <option value="4">4</option>
                <option value="4.5">4.5</option>
                <option value="5">5</option>
                <option value="5.5">5.5</option>
                <option value="6">6</option>
                <option value="6.5">6.5</option>
                <option value="7">7</option>
                <option value="7.5">7.5</option>
                <option value="8">8</option>
                <option value="8.5">8.5</option>
                <option value="9">9</option>
                <option value="9.5">9.5</option>
                <option value="10">10</option>      
            </select>
        </p>
        
        <p>
            Dodijelite oznaku:
            <input type="text" name="oznaka" />
        </p>
        
        <input type="submit" value="ocijeni" />
    </form>

<p>
    <a href="<?php echo \route\Route::get('d2')->generate(array(
        "controller" => "korisnik"
    ));?>">Vrati se u Portfelj!</a>
</p>
<?php
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
}
