<?php

class TlrTemplates
{
	private $pathcss;
    private $pathjs;
	
	public function __construct($css, $js){
		$this->pathcss = $css;
		$this->pathjs = $js;
	}
	
	public function include_css($css){		
		if(is_array($css)){
			foreach($css as $c){
				if(file_exists($c)){
					echo '<link rel="stylesheet" href="'.$c.'">';
				}
			}
		}else{
			echo '<link rel="stylesheet" href="'.$css.'">';
		}
			
	}
	
	public function include_js($js){		
		if(is_array($js)){
			foreach($js as $j){
				if(file_exists($j)){
					echo '<script src="'.$j.'"></script>';
				}
			}
		}else{
			echo '<script src="'.$js.'"></script>';
		}
	}
}

?>