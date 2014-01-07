<?php

namespace view;
use opp\view\AbstractView;

class Validation extends AbstractView {
    private $list;
    
    protected function outputHTML() {
        if(count($this->list)) {
		
			echo '<table class="table table-bordered table-hover">';
			foreach($this->list as $v) {
				echo "<tr><td>", $v->username, '</td>', "<td><a href=\"" . \route\Route::get('d3')->generate(array(
					"controller" => "ovlastenaOsobaCtl",
					"action" => "validate"
				)) . "?id=" . $v->idKorisnika . "\">Validiraj</a></td></tr>";
			}
        echo "</table>";
        } else {
            echo "Nema novih zahtjeva za registracijom!";
        }
        ?>
    <br><br><br>
    <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a>
<?php
    }
    
    public function setList($list) {
        $this->list = $list;
        return $this;
    }

}