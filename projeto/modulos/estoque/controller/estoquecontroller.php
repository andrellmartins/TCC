<?php 
class estoquecontroller extends crudcontroller{
    public function inicio(){
        $navbar = Navbar::render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Estoque');
        $interface->setContent($navbar . gerenciador_estoque::returnGrid(true));
        $interface->render();
    }

/*------ AREA DOS FORMS DE ESTOQUE */
    public function formInclui(){
        $funcionario = instanceClassFromModulo('pessoas','funcionario') -> getFuncionarioByIdPessoa($_SESSION['usuarioLogado']['id_pessoa']);

        if(!$funcionario){
            mensagensPadroes_estoque::apenasFuncionariosInseremEstoque();
        }
        $content = gerenciador_estoque::returnCadastroProduto(true, 'inclui','?modulo=estoque&programa=estoque&acao=inclui');
        $interface = new interfacePadrao;
        $interface->setTitulo('Incluir');
        $interface->setContent($content);
        $interface->render();
    }

    public function formAlterarProduto(){
        $formCadastro = gerenciador_estoque::returnCadastroProduto(true,'alterar','?modulo=estoque&programa=estoque&acao=alterarProduto&id='.$this->get['id'],$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Estoque - Alterar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
    }
    
    public function formVisualizaProduto(){
        $formCadastro = gerenciador_estoque::returnCadastroProduto(true,'visualizar','',$this->get['id']);
        $navbar = Navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Estoque - Visualizar');
        $interface->setContent($navbar . $formCadastro);
        $interface->render();
    }

/*------FIM DA AREA DOS FORMS DE ESTOQUE */

/*------ AREA TRATAMENTO DOS DADOS */
    public function inclui(){
        $funcionario = instanceClassFromModulo('pessoas','funcionario') -> getFuncionarioByIdPessoa($_SESSION['usuarioLogado']['id_pessoa']);

        if(!$funcionario){
            mensagensPadroes_estoque::apenasFuncionariosInseremEstoque();
        }
        $this->post['id_funcionario'] = $funcionario['id'];
        try{
            $this->model->incluir($this->post);
            mensagensPadroes_estoque::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes_estoque::erroNaInsercao($t->getMessage());
        }   
    }

    public function excluirProduto(){
        try{
            $this->model->excluir($this->get['id']);
            mensagensPadroes_estoque::delecaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes_estoque::erroNaDelecao($t->getMessage());
        }
    }

    public function alterarProduto(){
        try{
            $this->post['id'] = $this->get['id'];
            $this->model->alterar($this->post);
            mensagensPadroes_estoque::alterarBemSucedido($this->post);
        }catch(Throwable $t){
            mensagensPadroes_estoque::erroNaAlteracao($t->getMessage());
        }
    }

}