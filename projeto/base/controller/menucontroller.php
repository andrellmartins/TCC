<?php

class menucontroller extends controller{

    public function menu(){
            $menu = new menu;
            $content = navbar::render(true).$menu->render(true);
            $interface = new interfacePadrao;
            $interface->setTitulo('Menu');
            $interface->setContent($content);
            $interface->render();
            
        }
}