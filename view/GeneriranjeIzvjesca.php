<?php

namespace view;
use opp\view\AbstractView;

class GeneriranjeIzvjesca extends AbstractView {
    protected function outputHTML() {
?>
<p>
<form action="<?php echo \route\Route::get('d3')->generate(array(
    "controller" => "ekspertnaOsobaCtl",
    "action" => "generirajIzvjesce"
));?>" method="POST">
    <p>
        Želite li generirati izvješće po podrijetlu: &nbsp;
        <input type="checkbox" name="checked" value="true" />
        <br>
        Inače se izvješće generira prema prosječnim ocjenama!
    </p>
    <p>
        <input type="submit" value="Generiraj Izvještaj" />
    </p>
</form>
</p>
<?php
    }
}
