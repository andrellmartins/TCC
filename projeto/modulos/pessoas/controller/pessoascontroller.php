<?php
class pessoascontroller extends crudcontroller{

    public function __construct($modulo)
    {
        parent::__construct($modulo);
    }

    public function auth(){
        $acao = filter_input(INPUT_GET,'acao') ?? 'main';
        if(!in_array($acao,['inclui','login','formCadastro','main'])){
            parent::auth();
        }
    }

    public function inclui(){
        try{
            $this->model->inclui($this->post);
            mensagensPadroes::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes::erroNaInsercao($t->getMessage());
        }
    }

    public function exclui(){
        try{
            $this->model->del($this->post);
            mensagensPadroes::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes::erroNaInsercao($t->getMessage());
        }
    }

    public function listar(){
        try{
            $this->model->listar($this->get);
            //mensagensPadroes::($t->getMessage());
        }catch(Throwable $t){
            mensagensPadroes::erroNaInsercao($t->getMessage());
        }
    }


    public function login(){
        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');

        $usuario = new usuario;
        $login = $usuario->login($username,$password);
        if(!$login) {
            mensagensPadroes::erroNoLogin();
            exit;
        }
        Header('Location: ?modulo=base&programa=menu&acao=menu');
        
    }

    public function logoff(){
        session_destroy();
        Header('Location: ?');
    }
    public function main(){
        $login = new login;
        $content = $login->render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('login');
        $interface->setContent($content);
        $interface->render();
    }

    
    public function formCadastro(){
        $cadastro = new cadastro;
        $content = $cadastro->render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('cadastro');
        $interface->setContent($content);
        $interface->render();
    }

    public function grid()
    {
        $grid = new grid;
        $content = navbar::render(true).$grid->render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('menu');
        $interface->setContent($content);
        $interface->render();
        
    }
}
