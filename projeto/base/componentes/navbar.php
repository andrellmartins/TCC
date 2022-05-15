<?php

    class navbar{

        public static function render($return = false){
            ob_start();
            ?>
            <nav class="navbar navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">
                        <img src="?requestType=reqview&path=\logo-clinilog.png" alt="" width="30" height="24" class="d-inline-block align-text-top"> CliniLog
                    </a>
                </div>
                <div id="navbarNavDropdown" class="container-fluid">
                    <ul class="navbar-nav">
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Dropdown link
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                                <li><a class="dropdown-item" href="#">Action</a></li>
                                <li><a class="dropdown-item" href="#">Another action</a></li>
                                <li><a class="dropdown-item" href="#">Something else here</a></li>
                            </ul>
                        </li> 
                    </ul>
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
  