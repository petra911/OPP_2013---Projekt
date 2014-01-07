<?php

namespace view;
use opp\view\AbstractView;

class RezultatiPretrazivanjaEksperimenata extends AbstractView {
    
    private $var;
    
    public function setVar($var)
    {
        $this->var = $var;
        //return $this;
    }    
        
    protected function outputHTML() {
        /**
         * implementiraj;
         */		 
		echo '<table class="table table-bordered table-hover">
			<tr>
				<td><b>Ime i prezime autora</b></td>				
				<td><b>Naziv</b></td>
				<td><b>Početak eksperimenta</b></td>
				<td><b>Završetak eksperimenta</b></td>
				<td><b>Naziv IDE</b></td>				
                                <td><b>Naziv alata</b></td>
                                <td><b>Naziv platforme</b></td>
                                <td><b>Iznos rezultata</b></td>
				<td><b>Mjerna jedinica rezultata</b></td>
                                <td><b>Link</b></td>
                                <td><b>Link</b></td>
				<td></td>
			</tr>';
		for ($i = 0; $i < count($this->var['id']); $i++)
		{
			echo '<tr>';
			echo "<td>{$this->var['imeautor'][$i]}</td>";			
			echo "<td>{$this->var['naziv'][$i]}</td>";
			echo "<td>{$this->var['pocetak'][$i]}</td>";
			echo "<td>{$this->var['zavrsetak'][$i]}</td>";
			echo "<td>{$this->var['nazivide'][$i]}</td>";
                        echo "<td>{$this->var['nazivalat'][$i]}</td>";
                        echo "<td>{$this->var['nazivplatforma'][$i]}</td>";
			echo "<td>{$this->var['iznosrezultata'][$i]}</td>";
			echo "<td>{$this->var['mjjedinicarezultata'][$i]}</td>";			
					
			/* linkovi za dodavanje u portfelj i ocjenjivanje*/                 
                        
                        if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' )) {
			echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajEksperimentUPortfelj"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Dodaj u portfelj </a></td>";
                        
              
                       echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "ocijeni"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Ocijeni </a></td>";
                       
                       
                       echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "predloziKorekciju"
                            )) . "?id=" . $this->var['id'][$i] . "&var=E". "\"> Predloži korekciju </a></td>";
                       
                        }
                        echo '</tr>';
		}
		echo '</table>';
                
                ?> <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a> <?php
                
                
    }    
    
}