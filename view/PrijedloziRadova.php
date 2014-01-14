<?php

namespace view;
use opp\view\AbstractView;

class PrijedloziRadova extends AbstractView {
    private $prijedlozi;
    
    protected function outputHTML() {
        if (count($this->prijedlozi)) {
            echo "<table class='table table-bordered table-hover'>
			<tr>
				<td><b>Prijedlog</b></td>
				<td></td>
			</tr>";
            foreach ($this->prijedlozi as $v) {
                echo "<tr><td>" . $v->naslov . "</td><td><a href=\"" . \route\Route::get('d3')->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPrijedlogRada"
                )) ."?id=" . $v->id . "\">Obradi prijedlog</a></td></tr>";
            }
            echo "</table>";
            
        } else {
            echo "<p>Ne postoje novi prijedlozi!</p>";
        }
?>

<br />
<br />
<a href="<?php echo \route\Route::get("d1")->generate();?>">
	<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
</a>
<?php
    }
    
    public function setPrijedlozi($prijedlozi) {
        $this->prijedlozi = $prijedlozi;
        return $this;
    }


}