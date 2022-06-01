<?php 
class estoquecontroller extends crudcontroller{
    public function inicio(){
        $navbar = Navbar::render(true);
        $interface = new interfacePadrao;
        $interface->setTitulo('Gerenciador de Estoque');
        $interface->setContent($navbar . gerenciador_estoque::returnGrid(true));
        $interface->render();
    }

    /*------ AREA DOS FORMS DE PRODUTOS */
    public function formInclui(){
        $content = gerenciador_estoque::returnCadastroProduto('inclui','?modulo=estoque&programa=estoque&acao=inclui');
        $interface = new interfacePadrao;
        $interface->setTitulo('Incluir');
        $interface->setContent($content);
        $interface->render();
    }
}