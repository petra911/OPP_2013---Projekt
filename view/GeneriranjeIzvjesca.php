<?php

namespace view;
use opp\view\AbstractView;

class GeneriranjeIzvjesca extends AbstractView {
    protected function outputHTML() {
?>

<form action="<?php echo \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "generirajIzvjesce"
));?>" method="POST">
    <div class="form-group-textarea">
		<label for="karakt"><b>Želite li generirati izvješće po podrijetlu: &nbsp;</b></label>
        <input type="checkbox" name="checked" value="true" />
    </div>
    <br />
    
    <p><b>Inače se izvješće generira prema prosječnim ocjenama!</b>	</p>
    
    <br />
    
    <input type="submit" class="btn btn-primary" name="submit" value="Generiraj izvještaj" />
    
</form>
<br />
<br />

<a href="<?php echo \route\Route::get('d1')->generate();?>">
	<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
</a>   

<?php
    }
}
