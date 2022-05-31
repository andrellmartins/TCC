<?php
class mensagensPadroes_pessoas
{
//Mensagens Informação
    public static function msgBemVindo()
    {
        ob_start();
    ?>
        
            <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Bem Vindo ao Sistema</h4>
            <p>Você fez login e entrou no sistema. Seja Bem Vindo.</p>
            <hr>
            <p class="mb-0">Para fazer logoff, <a href="?modulo=pessoas&programa=pessoas&acao=logoff">clique aqui</a> </p>
        </div>
    <?php
        $content = ob_get_clean();
        return $content;
        
    }
    public static function alterarBemSucedido()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Usuário Inserido com sucesso!</h4>
            <p>Seu usuário foi criado com sucesso</p>
            <hr>
            <p class="mb-0"><a href="?modulo=pessoas&programa=pessoas&acao=inicio">clique aqui</a> para voltar para a consulta.</p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    public static function cadastroBemSucedido()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Usuário Inserido com sucesso!</h4>
            <p>Seu usuário foi criado com sucesso</p>
            <hr>
            <p class="mb-0"><a href="?">clique aqui</a> para testar seu novo usuário.</p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    public static function insercaoBemSucedida()
    {
        ob_start();
    ?>
        <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Usuário Inserido com sucesso!</h4>
            <p>Seu usuário foi criado com sucesso</p>
            <hr>
            <p class="mb-0"><a href="?modulo=pessoas&programa=pessoas&acao=inicio">clique aqui</a> para voltar para a consulta.</p>
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
            <h4 class="alert-heading">Pessoa Deletada com sucesso!</h4>
            <p>Pessoa foi deletado com sucesso, clique <a href="?modulo=pessoas&programa=pessoas&acao=inicio">aqui</a> para voltar para o grid</p>
            <hr>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }

    

//Mensagens Erro
    public static function usuarioNaologado()
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Acesso não permitido!</h4>
            <p>Nao foi possível acessar o sistema. Contate um administrador.</p>
            <hr>
            <p class="mb-0">Para voltar para tela de Login, <a href="?" >clique aqui</a> </p>
        </div>
    <?php
        $content = ob_get_clean();
        interfacePadrao::render_args($content);
    }
    public static function erroNoLogin()
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Tentativa de Login!</h4>
            <p>Nao foi possível acessar o sistema. Contate um administrador.</p>
            <hr>
            <p class="mb-0">Para voltar para tela de Login, <a href="?" >clique aqui</a> </p>
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
            <h4 class="alert-heading">Erro na Inserção!</h4>
            <p>Erro na tentativa de Inserção de um cadastro novo.</p>
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

    public static function erroNaInsercao($msg, $back = true)
    {
        ob_start();
    ?>
        <div class="alert alert-danger" role="alert">
            <h4 class="alert-heading">Erro na Inserção!</h4>
            <p>Erro na tentativa de Inserção de um cadastro novo.</p>
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

    public static function erroNaDelecao($msg, $back = true)
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

    

    
}
