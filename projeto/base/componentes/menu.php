<?php
class menu {
    //public function __construct(Array $arr_cabec,Array $dados){}

    
    public function render($return = false){
        ob_start();
        ?>
    <div class="container w-50 self-align-middle">
        <div class="row text-center">
                <div class="form-floating mb-3">
                    <button onclick="window.location='?modulo=pessoas&programa=pessoas&acao=formCadastro' "type="submit" class="btn btn-primary">Cadastrar</button>
                </div>
                <div class="form-floating mb-3">
                    <button onclick="window.location='?modulo=pessoas&programa=pessoas&acao=grid' "type="submit" class="btn btn-primary">Listar</button>
                </div>
                <div class="form-floating mb-3">
                    <button onclick="window.location='?modulo=base&programa=menu&acao=menu' "type="submit" class="btn btn-primary">Back</button>
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