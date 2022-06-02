<?php 
class mensagensPadroes{
    public static function msgBemVindo(){
        ob_start();
        ?>
        
            <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Bem Vindo ao Sistema</h4>
            <p>Você fez login e entrou no sistema. Seja Bem Vindo.</p>
        </div>
        <?php
        $content = ob_get_clean();
        return $content;
    }
    public static function msgHomeSistema(){
        ob_start();
        ?>
        
            <div class="alert alert-info" role="alert">
            <h4 class="alert-heading">Teste Algum Módulo</h4>
            <p>Acesse um módulo acima e selecione uma rotina.<br/> Lembre-se antes de sair, faça logoff</p>
        </div>
        <?php
        $content = ob_get_clean();
        return $content;
    }
}