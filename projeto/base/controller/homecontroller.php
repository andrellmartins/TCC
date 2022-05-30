<?php

class homecontroller extends controller{

    public function main(){
        $content = navbar::render(true);

        $interface = new interfacePadrao;
        $interface->setTitulo('Seja Bem Vindo '.$_SESSION['usuarioLogado']['nome'] );
        $interface->setContent($content);
        $interface->render();
            
    }
}