<?php
class Select{
	public $cont=0;
	public $values;
	public $labels;
	public $titles;	
	public $selectedValue=NULL;
	public $selectedPos=NULL;
	public $id;
	public $class;
	public $style;
	
	public function __construct(){
		$this->id = $id;
		$this->class = $class;
		$this->style = $style;
	}
	
	public function agregarOpcionesSQL($query, $con){
		try{
			$res = $con->execQuery($query);
			$tam= $con->num_rows($res);
			if($tam>0){
				while($fila = $con->getRow($res)){
					$value = $fila[0];
					$label = $fila[1];
					$this->agregarOpcion($value, $label, '');
				}
			}else{
				$this->agregarOpcion(-1,"NO SE ECONTRARON RESULTADOS"); 
			}

		}catch(Exception $e){
			throw new Exception("La sentencia SQL no es valida");
		}
	}
	
	public function agregarOpcion($value, $label, $title=''){
		$this->values[$this->cont]=$value;
		$this->labels[$this->cont]=$label;
		$this->titles[$this->cont]=$title;
		if($selected!=''){
			$this->$selected=$value;
		}
		$this->cont++;
	}
	
	public function agregarOpciones($array){
		for($i=0;$i<count($array);$$i++){
			$this->agregarOpcion($array[$i][0],$array[$i][1]);
		}
	}
	
	
	public function agregarObjeto($obj){
		$this->values[$this->cont]=$obj->getKey();
		$this->labels[$this->cont]=$obj->getLabel();
		if($selected!=''){
			$this->$selected=$value;
		}
		$this->cont++;
	}
	
	public function agregarObjetos($arr){
		foreach($arr as $obj){
			$this->agregarObjeto($obj);
		}
	}
	
	public function removerOpciones(){
		unset ($this->values);
		unset ($this->labels);
		$this->cont = 0;
		$this->selectedValue=NULL;
		$this->selectedIndex=NULL;
	}
	
	public function seleccionarValue($value){
		$this->selectedValue = $value;
		$this->selectedPos = NULL;
	}	

	public function seleccionarIndex($pos){
		$this->selectedPos = $pos;
		$this->selectedValue = NULL;
	}
	
	public function getHTML(){
		$x=0;
		foreach($this->values as $value){
			if(($value==$this->selectedValue&&$this->selectedValue!=NULL)||($this->selectedPos==$x&&$this->selectedPos!=NULL)){
				$html.="<option title='".$this->titles[$x]."' selected='selected' value = '$value'>".$this->labels[$x]."</option>\n";
			}else{
				$html.="<option title='".$this->titles[$x]."' value = '$value'>".$this->labels[$x]."</option>\n";	
			}
			$x++;
		}
		return $html;
	}
	
	public function getJavaScript($id){
		$java.='var sel = document.getElementById("'.$id.'");';
		$java.='sel.options.length = 0;';
		$x=0;
		foreach($this->values as $value){
			$label = $this->labels[$x];
			$title = $this->titles[$x];
			$java.='sel.options[sel.options.length] = new Option("'.$label.'","'.$value.'");';
			$java.='sel.options[sel.options.length-1].title="'.$title.'";';
			if(($value==$this->selectedValue&&$this->selectedValue!=NULL)||($this->selectedPos==$x&&$this->selectedPos!=NULL)){
				$java.="sel.options[$x].selected = true;";
			}
			$x++;
		}		

		return $java;
	}
	
	public function getCont(){
		return cont;
	}
}
?>