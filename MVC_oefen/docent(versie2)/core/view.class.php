<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

class View
{
    
    
    private $template;
    
    private $vars;
    
 
    public function __construct(){
        $this->vars = [];
    }

    
    public function setTemplate($value){
        $this->template = '../templates/' . $value . '.template.php';
    }
    
    /** 
     * Variabele toevoegen
     * - voeg een nieuw key-value-paar toe aan de associatieve array met variabelen. 
     */
    public function add($key, $value)
    {
        $this->vars[$key] = $value;
    }
    
    /** 
     * Het weergeven van de response
     * - pak de associatieve array met variabelen uit (levert locale variabelen)
     * - stop de template in de response
     */
    public function render()
    {
        extract($this->vars);
        require $this->template;
    }
}
