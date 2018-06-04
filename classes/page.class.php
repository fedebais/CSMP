<?php 

class pageList{
	
	var $TotalRegs;
	var $PageRegs 	= 10;
	var $ActualPage	= 1;	
	
	function __construct($TotalRegs, $ActualPage=1){
		$this->TotalRegs 	= $TotalRegs;
		if($ActualPage>=1)$this->ActualPage	= $ActualPage;
	}
	
	function calculatePages(){
		$TotalPages	= ceil($this->TotalRegs/$this->PageRegs);
		return $TotalPages;
	}
	
	function calculateRegFrom(){
		return (($this->ActualPage-1)*$this->PageRegs);
	}
	
	function calculateRegTo(){
		return ($this->ActualPage*$this->PageRegs)-1;
	}
	
	function getIntervalo(){
		return $this->calculateRegFrom().",".$this->PageRegs;
	}
	
	
	function insertPages(){
		$Pages = $this->calculatePages();
		if($Pages>=1){	
			$PageList = '<ul>';
			for ($i=1; $i<=$Pages; $i++){
				if($i==$this->ActualPage){
					$PageList .= '<li class="active">'.$i.'</li>';
				}else{
					$PageList .= '<li><a href="'.basename($_SERVER['PHP_SELF']).'?page='.$i.$this->getQueryString().'">'.$i.'</a></li>';
				}
			}
			$PageList .= '</ul>';
		}
		echo $PageList;
	}
	
	function insertLinkBack(){
		
		if($this->ActualPage!=1){
			return basename($_SERVER['PHP_SELF']).'?page='.($this->ActualPage-1).$this->getQueryString();
		}else{
			return "";
		}
	}
	
	function insertLinkFoward(){
		$Pags = $this->calculatePages();
		if($this->ActualPage!=$Pags){
			
			return basename($_SERVER['PHP_SELF']).'?page='.($this->ActualPage+1).$this->getQueryString();	
		
		}else{
			return "";
		}
	}
	
	function getQueryString(){
		$newString = "";
		$parametros = explode('&',$_SERVER['QUERY_STRING']);
		for($i=0;$i<count($parametros); $i++){
			$nombre_parametro = explode('=',$parametros[$i]);
			if(strtolower($nombre_parametro[0])!="page")$newString .=  "&".$parametros[$i];	
		}
		return $newString;
	}
	
	function insertBtnBack($BackOn,$BackOff){
		
		if($this->ActualPage!=1 && $this->TotalRegs>0){
			echo '<a href="'.$this->insertLinkBack().'"><div class="DivPageBackOn triggerAnterior" style="background-image:url('.$BackOn.');"></div><div class="tipAnterior">Anterior</div></a>';
		}else{
			echo '<div class="DivPageBackOff" style="background-image:url('.$BackOff.');"></div>';
		}
	}
	
	function insertBtnFoward($FowardOn,$FowardOff){
		$Pags = $this->calculatePages();
		if($this->ActualPage!=$Pags && $this->TotalRegs>0){
			echo '<a href="'.$this->insertLinkFoward().'"><div class="DivPageFowardOn triggerSiguiente" style="background-image:url('.$FowardOn.');"></div><div class="tipSiguiente">Siguiente</div></a>';	
		}else{
			echo '<div class="DivPageFowardOff" style="background-image:url('.$FowardOff.');"></div>';
		}
	}
		
}
		
?>