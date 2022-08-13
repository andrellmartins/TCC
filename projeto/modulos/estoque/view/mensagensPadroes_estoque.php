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
    
    public static function delecaoBemSucedida()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Produto Deletada com sucesso!</h4>
            <p>Produto foi deletado com sucesso, clique <a href="?modulo=estoque&programa=estoque&acao=inicio">aqui</a> para voltar para o grid</p>
            <hr>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    public static function alterarBemSucedido()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Produto Alterado com sucesso!</h4>
            <p>O produto foi alterado com sucesso</p>
            <hr>
            <p class="mb-0"><a href="?modulo=estoque&programa=estoque&acao=inicio">clique aqui</a> para voltar para a consulta.</p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    public static function sucessoNaInclusaoLote($msg, $back = true)
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Lotes Incluidos com Sucesso!</h4>
            <p>Os Lotes foram cadastrados com sucesso.</p>
            <hr>
            <?php
            if ($back) {
            ?>
                <p class="mb-0"><a href="?modulo=estoque&programa=estoque&acao=inicio">clique aqui</a> para voltar para a consulta.</p>
            <?php
            }
            ?>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

//Mensagens Erros
    public static function apenasFuncionariosInseremEstoque(){
        ob_start();
        ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Não é possível alterar!</h4>
            <p>Apenas Funcionários podem incluir estoque !</p>
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
    
    public static function erroNaDelecao($msg)
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Deleção!</h4>
            <p>Erro na tentativa de Deleção do cadastro.</p>
            <hr>
            <p><i><?php echo $msg ?></i></p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    public static function erroNaAlteracao($msg, $back = true)
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Alteração!</h4>
            <p>Erro na tentativa de Alteração de um produto.</p>
            <hr>
            <p><i><?php echo $msg ?></i></p>
            <?php
            if ($back) {
            ?>
                <p class="mb-0">Para voltar para o formulário anterior, <a href="#" onclick="history.back()">clique aqui</a> </p>
            <?php
            }
            ?>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }
    
    public static function erroNaInclusaoLote($msg, $back = true)
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Inclusão de Lote!</h4>
            <p>Erro na tentativa de Inclusão de Lote.</p>
            <hr>
            <p><i><?php echo $msg ?></i></p>
            <?php
            if ($back) {
            ?>
                <p class="mb-0">Para voltar para o formulário anterior, <a href="#" onclick="history.back()">clique aqui</a> </p>
            <?php
            }
            ?>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    
}
