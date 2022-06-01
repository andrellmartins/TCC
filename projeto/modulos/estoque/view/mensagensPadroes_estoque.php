<?php
class mensagensPadroes_estoque
{
//Mensagens Informação
    
    
    public static function insercaoBemSucedida()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Produto Inserido com sucesso!</h4>
            <p>Produto foi adicionado com sucesso</p>
            <hr>
            <p class="mb-0"><a href="?modulo=estoque&programa=estoque&acao=inicio">clique aqui</a> para voltar para a consulta.</p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }
    
    


    public static function erroNaInsercao($msg, $back = true)
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Inserção!</h4>
            <p>Erro na tentativa de Inserção de um cadastro de produto novo.</p>
            <hr>
            <p><i><?php echo $msg ?></i></p>
            <?php
            if ($back) {
            ?>
                <p class="mb-0">Para voltar para tela de Cadastro anterior, <a href="#" onclick="history.back()">clique aqui</a> </p>
            <?php
            }
            ?>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }
  

    
}
