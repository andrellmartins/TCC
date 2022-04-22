<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
<!-- JQUERY -->
    <script type="javascript" src="node_modules/jquery/dist/jquery.js"></script>
<!-- BOOTSTRAP -->
    <link  rel="stylesheet"  href="node_modules/bootstrap/dist/css/bootstrap.css">
    <script type="javascript" src="node_modules/bootstrap/dist/js/bootstrap.js"></script>
<!-- SWEETALERT -->
    <script type="javascript" src="node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
<div class="container w-50 self-align-middle">
    <div class="row text-center">
        <form action="modulos/pessoas/controller/pessoascontroller.php?acao=login" method="post">
            <div class="form-floating mb-3">
                <input class="form-control" id="username" name="username" placeholder="usuário" required>
                <label for="username">Usuário</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="password" id="password" placeholder="Senha" required>
                <label for="password">Senha</label>
            </div>
            <div class="form-floating mb-3">
                <p>Não tem Usuário ? <a href="/cadastro.php">Cadastre-se</a></p>
            </div>
            <div class="form-floating mb-3">
                <p>Esqueceu sua senha ? <a href="#">Clique Aqui</a></p>
            </div>
            <div class="form-floating mb-3">
                <button type="submit" class="btn btn-primary">Fazer Login</button>
            </div>
        </form>
    </div>
</div>
</body>
</html>