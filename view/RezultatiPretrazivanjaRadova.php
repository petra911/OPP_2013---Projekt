<?php

namespace view;
use opp\view\AbstractView;

class RezultatiPretrazivanjaRadova extends AbstractView {
    protected function outputHTML($data) {
        /**
         * implementiraj
         */
		 
		echo '<table border = "1" width = 100%>';
		for ($i = 0; $i < count($data); $i++)
		{
			echo '<tr>';
			echo "<td>{$var['imeautor'][$i]}</td>";
			echo "<td>{$var['prezimeautor'][$i]}</td>";
			echo "<td>{$var['naslov'][$i]}</td>";
			echo "<td>{$var['sazetak'][$i]}</td>";
			echo "<td>{$var['kljucnerijeci'][$i]}</td>";
			echo "<td>{$var['izvor'][$i]}</td>"; /* podaci o skupu ili časopisu */
			/* linkovi za dodavanje u portfelj*/
			echo "<a href="<?php echo \route\Route::get($var['id'][$i])->generate(array(
                    "controller" => "korisnik",
                    "action" => "dodajRadUPortfelj"));?>">Dodaj u portfelj</a>";			
			echo '</tr>';
		}
		echo '</table>';
		 
    }
}
