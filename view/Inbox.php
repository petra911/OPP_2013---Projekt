<?php

namespace view;
use opp\view\AbstractView;

class Inbox extends AbstractView {
    private $poruke;
    
    protected function outputHTML() {
        if(count($this->poruke)) {
            echo "<p><table class='table table-bordered table-hover'>
			<tr>
				<td>Pošiljatelj</td>
				<td>Poruka</td>
			</tr>";
            foreach($this->poruke as $v) {
                switch($v->idPosiljatelja) {
                    case '-1':
                        $posiljatelj = "Administrator";
                        break;
                    case '-2':
                        $posiljatelj = "Ekspertna Osoba";
                        break;
                    default:
                        break;
                }
                echo "<tr><td>" . $posiljatelj . "</td><td>" . $v->tekst . "</td></tr>";
            }
            echo "</table></p>";
        } else {
            echo "<p>Nemate novih poruka!</p>";
        }
?>
        <p><b>Napomena:</b> Poruke se nakon čitanja automatski brišu!</p>
		<br><br>
		<a href="<?php echo \route\Route::get('d2')->generate(array(
																"controller" => "korisnik"
																));?>">
			<img src="../assets/img/home-icon.jpg" alt="Vrati se u portfelj" height="50" />
		</a>
<?php
    }
    
    public function setPoruke($poruke) {
        $this->poruke = $poruke;
        return $this;
    }

}