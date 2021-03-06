<?php

namespace view;
use opp\view\AbstractView;

class Akcije extends AbstractView {
    /**
     *
     * @var array[] 
     */
    private $zapisi;
        
    protected function outputHTML() {
        if(count($this->zapisi)) {
        echo "<table class='table table-bordered table-hover'>
            <tr>
            <th>
                Korisnik
            </th>
            <th>
                Vrijeme
            </th>
            <th>
                Opis Akcije
            </th>
            </tr>";
        foreach($this->zapisi as $v) {
            echo "<tr><td>" . $v["korisnik"] . "</td><td>" . $v["vrijeme"] . "</td><td>" . $v["opis"] . "</td></tr>";
        }
        echo "</table>";
        }
        else {
            echo new components\ErrorMessage(array(
                                "errorMessage" => "Ne postoji niti jedan zapis!"
                            ));
        }
        ?>
		<br><br>
        <a href="<?php echo \route\Route::get('d1')->generate();?>">
			<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
		</a>
<?php
    }
    
    public function setZapisi($zapisi) {
        $this->zapisi = $zapisi;
        return $this;
    }

}