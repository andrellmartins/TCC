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
        $content = gerenciador_estoque::returnCadastroProduto('inclui','?modulo=estoque&programa=estoque&acao=inclui');
        $interface = new interfacePadrao;
        $interface->setTitulo('Incluir');
        $interface->setContent($content);
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
            $this->model->inclui($this->post);
            mensagensPadroes_estoque::insercaoBemSucedida();
        }catch(Throwable $t){
            mensagensPadroes_estoque::erroNaInsercao($t->getMessage());
        }   
    }



}