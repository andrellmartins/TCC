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
        $insert = $this->model->inclui($this->post);
        if($insert === true){
            mensagensPadroes::insercaoBemSucedida();
        }else{
            mensagensPadroes::erroNaInsercao($insert);
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
        Header('Location: ?modulo=pessoas&programa=pessoas&acao=index');
    }
    public function index(){
        mensagensPadroes::msgBemVindo();
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
}
