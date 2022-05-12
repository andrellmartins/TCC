<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
<!-- JQUERY -->
    <script src="node_modules/jquery/dist/jquery.js"></script>
<!-- BOOTSTRAP -->
    <link  rel="stylesheet"  href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<!-- SWEETALERT -->
    <script src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="container w-50 self-align-middle">
    <div class="row text-center">
        <form action="modulos\pessoas\controller\pessoascontroller.php?acao=incluirpessoa" method="post">
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="nome" id="floatingNome" placeholder="Nome" required>
                <label for="floatingNome">Nome</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="endereço" id="floatingEndereço" placeholder="Endereço" required>
                <label for="floatingEndereço">Endereço</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="telefone" id="floatingTelefone" placeholder="Telefone" required>
                <label for="floatingTelefone">Telefone</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="cpf" id="floatingCpf" placeholder="Cpf" required>
                <label for="floatingCpf">Cpf</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="pis" id="floatingPis" placeholder="Pis" required>
                <label for="floatingPis">Pis</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="tipo" id="floatingTipo" placeholder="Tipo" required>
                <label for="floatingTipo">Tipo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Input" class="form-control" name="usuario" id="floatingUsuario" placeholder="Usuario" required>
                <label for="floatingUsuario">Usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="Password" class="form-control" name="senha" id="floatingSenha" placeholder="Senha" required>
                <label for="floatingSenha">Senha</label>
            </div>
            <div class="form-floating mb-3">
                <p>Já tem Usuário ? <a href="/">Faça Login</a></p>
            </div>
            <div class="form-floating mb-3">
                <button type="submit" class="btn btn-primary">Cadastrar</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>