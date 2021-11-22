<?php



Class BiciElectrica {

   
    private $id;
    private $coordx;
    private $coordy;
    private $bateria;
    private $operativa;


    public function __get($name)
    {
        if ( property_exists($this,$name)){
            return $this->$name;
        } else {
            return null;
        }

    }

    public function __set($name, $value)
    {
        if ( property_exists($this,$name)){
            $this->$name = $value;
        }
    }

    // Distancia de la bici a un punto
    function distancia($x, $y):float
    {
        return sqrt( ($x-$this->coordx)*($x-$this->coordx)+($y-$this->coordy)*($y-$this->coordy));
    }

    function __toString()
    {
        return "Identificador: $this->id Bateria $this->bateria %";
    }





}