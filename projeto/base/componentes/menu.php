<?php
class menu{
    public function render($return = false){
        ob_start();
        ?>
        <div class="container w-50 self-align-middle">
            <div class="row text-center">
                    <div class="form-floating mb-3">
                        <button onclick="window.location='?modulo=pessoas&programa=pessoas&acao=grid'" type="submit" class="btn btn-primary">Gerenciador de Pessoas</button>
                    </div>
                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-primary">Gerenciador de Estoque</button>
                    </div>
                    <div class="form-floating mb-3">
                        <button type="submit" class="btn btn-primary">Gerenciador Financeiro</button>
                    </div>
                    <div class="form-floating mb-3">
                        <button onclick="window.location='?modulo=pessoas&programa=pessoas&acao=logoff'" type="submit" class="btn btn-primary">Logoff</button>
                    </div>
                </form>
            </div>
        </div>
    <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
        
    }
}