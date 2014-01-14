<?php

namespace view;
use opp\view\AbstractView;

class Prijedlozi extends AbstractView {
    private $poruke;
    
    protected function outputHTML() {
        if (count($this->poruke)) {
            echo "<table class='table table-bordered table-hover'>
			<tr>
				<td><b>Prijedlog</b></td>
				<td></td>
			</tr>";
            foreach ($this->poruke as $v) {
                echo "<td><q>{$v->tekst}</q></td><td><a href=\"" . \route\Route::get("d3")->generate(array(
                    "controller" => "ekspertnaOsobaCtl",
                    "action" => "displayPrijedlogZaKorekciju"
                )) . "?id={$v->id}\">Obradi zahtjev</a></td></tr>";
            }
            echo "</table>";
        } else {
            ?>
            <p>Nemate novih prijedloga!</p>
<?php
        }
        
?>			<br /><br />
            <a href="<?php echo \route\Route::get('d1')->generate();?>">
            	<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
			</a>         
<?php
    }
    
    public function setPoruke($poruke) {
        $this->poruke = $poruke;
        return $this;
    }



}