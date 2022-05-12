<?php
class login{
    public function render($return = false){
        ob_start();
        ?>
    <div class="container w-50 self-align-middle">
        <div class="row text-center">
            <form action="?modulo=pessoas&programa=pessoas&acao=login" method="post">
                <div class="form-floating mb-3">
                    <input class="form-control" name="username" id="username" placeholder="usuário" required>
                    <label for="username">Usuário</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                    <label for="password">Senha</label>
                </div>
                <div class="form-floating mb-3">
                    <p>Não tem Usuário ? <a href="?modulo=pessoas&programa=pessoas&acao=formCadastro">Cadastre-se</a></p>
                    <p><a href="#">Equeceu a Senha ? </a></p>
                </div>
                <div class="form-floating mb-3">
                    <button type="submit" class="btn btn-primary">Fazer Login</button>
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