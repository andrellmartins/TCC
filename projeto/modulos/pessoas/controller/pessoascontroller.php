<?php
class pessoascontroller extends crudcontroller{
//personalização auth
    public function auth(){
        $acao = filter_input(INPUT_GET,'acao') ?? 'main';
        if(!in_array($acao,['cadastro','login','formCadastro','main'])){
            parent::auth();
        }
    }
//telas de visualização
    //grid
    public function inicio(){
        $navbar = Navbar::render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas');
        $interface->setContent($navbar . gerenciador_pessoas::returnGrid(true));
        $interface->render();
    }
    //login
    public function main(){
        $login = new gerenciador_pessoas;
        $content = $login->returnLogin(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('login');
        $interface->setContent($content);
        $interface->render();
    }
    
/*------OUTRAS ACOES------*/
    //autenticação
    public function login(){
        $username = filter_input(INPUT_POST,'username');
        $password = filter_input(INPUT_POST,'password');

        $usuario = new usuario;
        $login = $usuario->login($username,$password);
        if(!$login) {
            mensagensPadroes_pessoas::erroNoLogin();
            exit;
        }
        Header('Location: ?modulo=base&programa=home');
    }
    public function logoff(){
        session_destroy();
        Header('Location: ?');
    }
/*------FIM OUTRAS ACOES------*/

/*------INICIO AREA DOS FORMS------*/
    public function formAlterarPessoa(){
        $formCadastro = gerenciador_pessoas::returnCadastroPessoa(true,'alterar','?modulo=pessoas&programa=pessoas&acao=alterarPessoa&id='.$this->get['id'],$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas - Alterar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
    }
    
    public function formVisualizaPessoa(){
        $formCadastro = gerenciador_pessoas::returnCadastroPessoa(true,'visualizar','',$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Pessoas - Visualizar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
    }

    public function formInclui(){
        $content = gerenciador_pessoas::returnCadastroPessoa(true,'inclui','?modulo=pessoas&programa=pessoas&acao=inclui');
        $interface = new interfacePadrao;
        $interface->setTitulo('Incluir');
        $interface->setContent($content);
        $interface->render();
    }

    public function formCadastro(){
        $content = gerenciador_pessoas::returnCadastroPessoa(true,'login');
        $interface = new interfacePadrao;
        $interface->setTitulo('cadastro');
        $interface->setContent($content);
        $interface->render();
    }
/*------FIM AREA DOS FORMS------*/
/*------INICIO TRATAMENTO ENTRADA DADOS------*/
    public function inclui(){
        try{
            $this->model->inclui($this->post);
            mensagensPadroes_pessoas::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes_pessoas::erroNaInsercao($t->getMessage());
        }
    }
    public function alterarPessoa(){
        try{
            $this->post['id'] = $this->get['id'];
            $this->model->alterar($this->post);
            mensagensPadroes_pessoas::alterarBemSucedido($this->post);
        }catch(Throwable $t){
            mensagensPadroes_pessoas::erroNaAlteracao($t->getMessage());
        }
    }
    public function cadastro(){
        try{
            $this->model->inclui($this->post);
            mensagensPadroes_pessoas::cadastroBemSucedido();
        }catch(Throwable $t){
            mensagensPadroes_pessoas::erroNaInsercao($t->getMessage());
        }
    }
    public function excluirPessoa(){
        try{
            $this->model->excluir($this->get['id']);
            mensagensPadroes_pessoas::delecaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes_pessoas::erroNaDelecao($t->getMessage());
        }
    }
/*------FIM TRATAMENTO ENTRADA DADOS------*/

}