<?php
    class crudcontroller extends controller{
        public function __construct($modulo){
            parent::__construct($modulo);
            $controllerName = get_class($this);
            $modelName = substr($controllerName,0,strlen($controllerName)-10);

            $this->model = new $modelName;
            $this->auth();
        }
        public function auth(){
            $usuario = new usuario;
            $auth = $usuario->auth();
            if(!$auth){
                mensagensPadroes::usuarioNaoLogado();
                exit;
            }
        }
    }
