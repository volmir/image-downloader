<?php

namespace PVV\sys;

/** 
* Class View
* @package PVV\sys
*/
class View {
 
    /**
     *
     * @var string
     */
    private $path;
    /**
     *
     * @var array
     */
    public $vars = array();    
    
    public function __construct($path) {        
        $this->path = ROOT_PATH . '/' . $path . '/';        
    }    

    /**
     * Set variables
     *
     * @param variable name $name
     * @param variable value $value
     */
    public function set($name, $value) {
        $this->vars[$name] = $value;
    }

    /**
     * Clear view data
     *
     */
    public function clear() {
        unset($this->vars);
    }

    /**
     * Parse template
     *
     * @param filename $template
     * @return text
     */
    public function parse($template) {
        if (file_exists($this->path . $template)) {
            if (count($this->vars)) {
                extract($this->vars, EXTR_SKIP);
            }

            ob_start();
            include($this->path . $template);
            $output = ob_get_contents();
            ob_end_clean();

            return $output;
        } else {
            throw new \Exception('The template file "' . $template . '" does not exist');
        }
    }

    /**
     * Show template content
     *
     * @param string $template
     */
    public function render($template) {
        $content = $this->parse($template);        
        echo $content;
    }  
}



