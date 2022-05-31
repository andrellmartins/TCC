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

    public function inicio(){
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas');
        $interface->setContent($navbar . gerenciador_pessoas::returnGrid());
        $interface->render();
    }

    public function inclui(){
        try{
            $this->model->inclui($this->post);
            mensagensPadroes::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes::erroNaInsercao($t->getMessage());
        }
    }

    public function excluirPessoa(){
        try{
            $this->model->excluir($this->get['id']);
            mensagensPadroes::delecaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes::erroNaDelecao($t->getMessage());
        }
    }
    
    public function formAlterarPessoa(){
        $formCadastro = gerenciador_pessoas::returnCadastro(true,'alterar','?modulo=pessoas&programa=pessoas&acao=alterarPessoa&id='.$this->get['id'],$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas - Alterar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
    }
    
    public function formVisualizaPessoa(){
        $formCadastro = gerenciador_pessoas::returnCadastro(true,'visualizar','',$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas - Visualizar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
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
        Header('Location: ?modulo=base&programa=home');
        
    }

    public function logoff(){
        session_destroy();
        Header('Location: ?');
    }
    public function main(){
        $login = new gerenciador_pessoas;
        $content = $login->returnLogin(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('login');
        $interface->setContent($content);
        $interface->render();
    }

    
    public function formCadastro(){
        $cadastro = new gerenciador_pessoas;
        $content = $cadastro->returnCadastro(true,true);
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
