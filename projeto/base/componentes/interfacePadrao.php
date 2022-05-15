<?php
class interfacePadrao{
    private $titulo;
    private $content;

    public function setTitulo($titulo){
        $this->titulo = $titulo;
    }
    public function setContent($content){
        $this->content = $content;
    }

    public static function render_args($content,$titulo = ''){
        $main = new interfacePadrao;
        $main->setContent($content);
        $main->setTitulo($titulo);
        $main->render();
    }



    public function render(){
       
            ?>
        <html lang="pt-BR">
        <?php echo header::getFullHeaders($this->titulo) ?>
        <body>
            <?php echo $this->content ?>
        </body>
        </html>
                    <?php
            
    }

   
}