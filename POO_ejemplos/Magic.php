<?php

class Magic
{
    private $atributo1;
    private $atributo2;
    private $varios= [];
    
    public function __construct(int $valor=0){
        $this->atributo1 = $valor;  
        $this->atributo2 = 0;
    }
    
    public function __set($nombre,$valor){
        // Compruebo un atributo concreto
        if ( $nombre == "atributo1"){
            $this->atributo1 = $valor;
        }
        // Puedo detectar si es uno atributo 
        // Ej atributo2
        // Admite el nombre de clase o un objeto
        if ( property_exists($this, $nombre)){
            $this->$nombre = $valor; // Ojo $nombre con DOLAR
        } 
        
    }
    
    public function __get($nombre){
        // Compruebo un atributo concreto
        if ( $nombre == "atributo1"){
             return $this->atributo1;
        }
        // Puedo detectar si es uno atributo
        // Ej atributo2
        $class = get_class($this);
        if ( property_exists($class, $nombre)){
             return  $this->$nombre;
        }
        else{
            return "El valor no está definido";
        }
    }
    
    public function __toString() {
        $resu  ="<p>Objeto de tipo ".get_class($this)."<br>\n";
        $resu .="Atributo 1 = $this->atributo1 <br>\n";
        $resu .="Atributo 2 = $this->atributo2 <br>\n";
        $resu .="</p>";
        return $resu;
    }
    
    
    private function noimplementada ($metodo){
        echo " Error funcion $metodo no está implementada. \n";
    }
    
 
    
    public function incrementa (){
        $this->atributo1++;
        $this->atributo2++;
    }
    
    
    
    public function __call($metodo,$parametros){
            $this->noimplementada($metodo);
     }
            
}

