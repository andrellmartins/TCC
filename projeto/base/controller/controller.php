<?php

class controller{
    protected $post;
    protected $get;
    protected $modulo;
    
    public function __construct($modulo)
    {
        $this->post = filter_input_array(INPUT_POST) ?? [];
        $this->get = filter_input_array(INPUT_GET) ?? [];

        $this->modulo = $modulo;
    }
    
    function getSysPath(){
        return syspath('modulos'. DIRECTORY_SEPARATOR . $this->modulo . DIRECTORY_SEPARATOR);
    }
    function getReqPath(){
        return reqpath('modulos'. DIRECTORY_SEPARATOR . $this->modulo . DIRECTORY_SEPARATOR);
    }
}