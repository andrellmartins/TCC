<?php

class menucontroller extends controller{

    public function menu(){
            $menu = new menu;
            $content = navbar::render(true).$menu->render(true);
            if($_SESSION['usuarioLogado']){
                mensagensPadroes::msgBemVindo();
                $_SESSION['usuarioLogado'] = false;
            }
            $interface = new interfacePadrao;
            $interface->setTitulo('Menu');
            $interface->setContent($content);
            $interface->render();
            
        }
}