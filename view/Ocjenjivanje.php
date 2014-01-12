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
            <label><b>Odaberite ocjenu</b></label>
            <select class="form-control" name="ocjena">
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
        
        <div class="form-group">
			<label for="karakt"><b>Oznaka</b></label>
			<input type="text" class="form-control" id="karakt" placeholder="Upišite oznaku, npr. dobro, loše" name="oznaka" />
		</div>
		<br>
        
        <input type="submit" class="btn btn-default" value="Ocijeni" />
    </form>

		<br><br>
		<a href="<?php echo \route\Route::get('d2')->generate(array(
																"controller" => "korisnik"
																));?>">
			<img src="../assets/img/home-icon.jpg" alt="Vrati se u portfelj" height="50" />
		</a>
<?php
    }
    
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
}
