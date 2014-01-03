<?php

namespace view;
use opp\view\AbstractView;

class RezultatiPretrazivanjaEksperimenata extends AbstractView {
    
    protected function outputHTML($data) {
        /**
         * implementiraj;
         */		 
		echo '<table border = "1" width = 100%>';
		for ($i = 0; $i < count($data); $i++)
		{
			echo '<tr>';
			echo "<td>{$var['imeautor'][$i]}</td>";
			echo "<td>{$var['prezimeautor'][$i]}</td>";
			echo "<td>{$var['naziv'][$i]}</td>";
			echo "<td>{$var['pocetak'][$i]}</td>";
			echo "<td>{$var['zavrsetak'][$i]}</td>";
			echo "<td>{$var['nazivparam'][$i]}</td>";
			echo "<td>{$var['iznosrezultata'][$i]}</td>";
			echo "<td>{$var['jedinicarezultata'][$i]}</td>";			
					
			/* linkovi za dodavanje u portfelj i ocjenjivanje*/
			echo "<a href="<?php echo \route\Route::get($var['id'][$i])->generate(array(
                    "controller" => "korisnik",
                    "action" => "dodajEksperimentUPortfelj"));?>">Dodaj u portfelj</a>";
			echo "<a href="<?php echo \route\Route::get($var['id'][$i])->generate(array(
                    "controller" => "korisnik",
                    "action" => "dodajRadUPortfelj"));?>">Ocijeni</a>";
			echo '</tr>';
		}
		echo '</table>';
		 
		 
    }
}