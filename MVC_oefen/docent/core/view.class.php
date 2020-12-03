<?php

/**
 * @author Jeroen van den Brink
 * @copyright 2020
 */

namespace core;

class View
{
    /** de template */
    private $template;
    
    /** de variabelen */
    private $vars;
    
    /** de constructor */
    public function __construct()
    {
        $this->vars = [];
    }
    
    /** SETTERS */
    public function setTemplate($value)
    {
        $this->template = '../templates/' . $value . '.template.php';
    }
    
    /** variabele toevoegen */
    public function add($key, $value)
    {
        $this->vars[$key] = $value;
    }
    
    /** het weergeven van de response */
    public function render()
    {
        extract($this->vars);
        require $this->template;
    }
}
