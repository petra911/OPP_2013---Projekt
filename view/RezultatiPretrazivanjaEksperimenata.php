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
				<td><b>Pocetak eksperimenta</b></td>
				<td><b>Zavrsetak eksperimenta</b></td>	
                                <td><b>Ocjena</b></td>	
                                <td><b>Link</b></td>
                                <td><b>Link</b></td>
                                <td><b>Link</b></td>
				
			</tr>';
		for ($i = 0; $i < count($this->var['id']); $i++)
		{                    
			echo '<tr>';
			echo "<td>{$this->var['imeautor'][$i]}</td>";			
			if (isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' || $_SESSION['vrsta'] == 'E')) {
                            echo "<td><a href=\"" . \route\Route::get('d3')->generate(array(
                                "controller" => "korisnik",
                                "action" => "displayPDFEksperimenta"
                            )) ."?id={$this->var['id'][$i]}\">{$this->var['naziv'][$i]}</a></td>";
                        } else {
                            echo "<td>{$this->var['naziv'][$i]}</td>";
                        }
			echo "<td>{$this->var['pocetak'][$i]}</td>";
			echo "<td>{$this->var['zavrsetak'][$i]}</td>";               
                        echo "<td>{$this->var['ocjena'][$i]}</td>";  
						
					
			/* linkovi za dodavanje u portfelj i ocjenjivanje*/                 
                        
                        
                        if(isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' )) {
			
                            $portfelj = new \model\DBPortfelj();
                            if (!$portfelj->postojiZapis($_SESSION['auth'], $this->var['id'][$i], null)) {
                            echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "dodajEksperimentUPortfelj"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Dodaj u portfelj </a></td>";
                            }
              
                       
                            
                            echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "displayOcjenjivanje"
                            )) . "?id=" . $this->var['id'][$i] . "\"> Ocijeni </a></td>";
                             
                       
                       echo "<td> <a href=\"" . \route\Route::get('d3')->generate(array(
                            "controller" => "korisnik",
                            "action" => "displayPredlaganjeKorekcije"
                            )) . "?id=" . $this->var['id'][$i] . "&v=E". "\"> Predloži korekciju </a></td>";
                       
                        }
                        
                        echo '</tr>';
		}
		echo '</table>';
                
                if (isset($_SESSION['vrsta']) && ($_SESSION['vrsta'] == 'K' || $_SESSION['vrsta'] == 'E')) {
                    echo '<p><b>Napomena: </b>Da biste skinuli pdf verziju eksperimenta kliknite na njegov naziv!</p>';
                }
                
                ?> <a href="<?php echo \route\Route::get('d1')->generate();?>">
		<img src="../assets/img/home-icon.jpg" alt="Vrati se na naslovnicu" height="50" />
	</a> <?php
                
                
    }    
    
}