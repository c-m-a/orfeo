<?php
class easyXML {
    function easyXML($file_or_string='',$string=false) {
        //se toma la cedena del origen 
        if($string) $data = $file_or_string;
        elseif(!$data = @file_get_contents($file_or_string)) return false;
        $data = trim($data);
        //iniciamos el parser SAX
        $parser = xml_parser_create();
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        if(!xml_parse_into_struct($parser, $data, $values, $tags)) return false;
        
        xml_parser_free($parser); 
        //recorremos los valores del XML para crear el arbol
        foreach($values as $key) {
            //retocamos las variables de cada elemento
            $type   = $key['type'];
            $tag    = strtolower(str_replace(":","_",$key['tag']));
            $level  = $key['level'];
            $atts   = isset($key['attributes']) ? $key['attributes'] : '' ;
            $value  = isset($key['value']) ? $this->decode($key['value']) : '' ;
            //existen 3 tipos: open, complete y close
            if($type=='open') {
                //en caso de existir los atributos los aÒadimos
                if($atts) 
                    foreach($atts as $key=>$value) $bdtemp[$level]['atts'][str_replace(":","_",$key)] = $this->decode($value);
            } elseif($type=='close') {
                //incluimos las variables de ese mismo level a un level inferior
        		$bdtemp[$level-1][$tag][] = $bdtemp[$level];
                unset($bdtemp[$level]);
            } else {
                //creamos el array segun el contenido
                if($atts) {
                    foreach($atts as $key_atts=>$value_atts) 
                        $atts_item[str_replace(":","_",$key_atts)] = $this->decode($value_atts); 
                    if($value) 
                        $content = array('atts'=>$atts_item,$tag=>$value);
                    else 
                        $content = array('atts'=>$atts_item);
                    unset($atts_item);
                } else {
                    $content = $value;
                }
                //lo aÒadimos a la variable temporal
                $bdtemp[$level-1][$tag][] = $content;
            }
        }
        //creamos el objeto
        $xml = new easyXML_Element($this->clean($bdtemp));
        $root = key($xml);
        $this->$root = $xml->$root;
    }
    function clean($array=array()) {
        //contamos el numero de items
        $i=count($array);
        $return= array();
        //recorremos el array
        foreach($array as $key => $value) {
            //si existe solo un elemento devolvemos una cadena
            if($key===0 and $i==1){
                if(is_array($value)) $return = $this->clean($value);
                else $return = $value;
            } else {
            //en caso de varios el retorno es un array
                if(is_array($value)) $return[$key] = $this->clean($value);
                else $return[$key] = $value;
            }
        }
        return $return;
    }
    
    function decode($in_str) {
   	    $new_str = str_replace("?", "q0u0e0s0t0i0o0n", $in_str);
   	    $new_str = utf8_decode($new_str);
   	    if (strpos($new_str,"?") !== false) $new_str = $in_str;
   	    else $new_str = str_replace("q0u0e0s0t0i0o0n", "?", $new_str);
   	    return $new_str;
    }
}

class easyXML_Element {
    function easyXML_Element($array=array(),$a=false) {
        if($a) $r = array(); 
        foreach($array as $k => $v) {
            if($a){
                if(is_array($v)){
                    if(is_numeric(key($v))) $r[$k] = $this->easyXML_Element($v,true);
                    else $r[$k] = new easyXML_Element($v);
                } else {
                    $r[$k] = $v;
                }
            } elseif(is_array($v)) {
                if(is_numeric(key($v))) $this->$k = $this->easyXML_Element($v,true);
                else $this->$k = new easyXML_Element($v);
            } else {
                $this->$k = $v;
            }
        }
        if($a) return $r; 
    }
}

function easyXML($xml='',$str=false) { return new easyXML($xml,$str); }
/*$xml='<flujo><descripcion>Prueba 123456 JGL</descripcion><nodo id=\"4\"><nombre>Etapa 4</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"3\"><nombre>Etapa 3</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"2\"><nombre>Etapa 2</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"1\"><nombre>Etapa 1</nombre><termino>-1</termino><proceso>0</proceso></nodo><arista id=\"26143190\"><termino>-1</termino><proceso>0</proceso><origen>3</origen><destino>4</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"25771774\"><termino>-1</termino><proceso>0</proceso><origen>1</origen><destino>2</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"24418135\"><termino>-1</termino><proceso>0</proceso><origen>2</origen><destino>3</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"25062038\"><termino>-1</termino><proceso>0</proceso><origen>2</origen><destino>4</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista></flujo>
';
$documento=easyXML(str_replace('\"','"',$xml),true);
print "<br />";
print count($documento->flujo->nodo);
print_r($documento->flujo->nodo);
print "<br />";
print "<br /> tiene ARISTAS";
print is_array($documento->flujo->arista)." <br />";
print "<br />";
print "<br />";
print_r($documento->flujo->arista->atts->id);
print "<br /> nombre del flujo:   ".$documento->flujo->descripcion;

print "<br />";
//print_r($documento)." <br />";//.print_r($documento);
*/
$xml=
'<flujo><descripcion>Jefe Proceso 1</descripcion><nodo id=\"5\"><nombre>Etapa 4</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"4\"><nombre>Etapa 3</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"3\"><nombre>Etapa 2</nombre><termino>-1</termino><proceso>0</proceso></nodo><nodo id=\"2\"><nombre>Etapa 1</nombre><termino>-1</termino><proceso>0</proceso></nodo><arista id=\"21491205\"><termino>-1</termino><proceso>0</proceso><origen>3</origen><destino>5</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"18916478\"><termino>-1</termino><proceso>0</proceso><origen>2</origen><destino>3</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"20812788\"><termino>-1</termino><proceso>0</proceso><origen>3</origen><destino>4</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista><arista id=\"29140465\"><termino>-1</termino><proceso>0</proceso><origen>4</origen><destino>5</destino><diasminimo>-1</diasminimo><diasmaximo>-1</diasmaximo><automatico>false</automatico><tipificacion>false</tipificacion></arista></flujo>
 ';


$documento=easyXML(str_replace('\"','"',$xml),true);
if (is_array($documento->flujo->nodo)){
					
				
					foreach ($documento->flujo->nodo as $clave=> $value ){
						
						echo "<br>nombre: " . $value->nombre;
						echo "<br>ID: " . $value->atts->id;
						echo  "<br>Termino: " . $value->termino;
						echo  "<br>Proceso: " . $procesoSelected ;	
						
		 										
					
				}
}

if (is_array($documento->flujo->arista)){
					
				
				foreach ($documento->flujo->arista as $clave=> $value ){
					echo "<br>origen: " . $value->origen;
						echo "<br>Destino: " . $value->destino;
						echo  "<br>ID: " . $value->atts->id;
						
				  
					
				}
}

?>