<?php

class homecontroller extends controller{

    public function main(){
        $content = navbar::render(true);
        if(!isset($_SESSION['trazBemVindo']))
            $content .= mensagensPadroes::msgBemVindo();
        else 
            $content .= mensagensPadroes::msgHomeSistema();
        $_SESSION['trazBemVindo'] = 1;

        $interface = new interfacePadrao;
        $interface->setTitulo('Seja Bem Vindo '.$_SESSION['usuarioLogado']['nome'] );
        $interface->setContent($content);
        $interface->render();
            
    }
}