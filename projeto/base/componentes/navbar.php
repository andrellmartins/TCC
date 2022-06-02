<?php

    class navbar{

        public static function render($return = false){
            ob_start();
            ?>

<nav class="navbar navbar-expand-md navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-brand" href="?modulo=base&programa=home">
      <img src="?requestType=reqview&path=\logo-clinilog1.png" alt="" height="24" class="d-inline-block align-text-top"> CliniLog
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbar_dropdown_pessoas" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Módulo de pessoas
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbar_dropdown_pessoas">
            <li><a class="dropdown-item" href="?modulo=pessoas&programa=pessoas&acao=inicio">Gerenciador de Pessoas</a></li>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbar_dropdown_estoque" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Módulo de Estoque
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbar_dropdown_estoque">
            <li><a class="dropdown-item" href="?modulo=estoque&programa=estoque&acao=inicio">Gerenciador de Produtos</a></li>
          </ul>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="?modulo=pessoas&programa=pessoas&acao=logoff">Sair</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

        <?php
        $content = ob_get_clean();
        if($return){
            return $content;
        }
        echo $content;
    }
}
  