<?php
class header {
    private function __construct(){}

    public static function getFullHeaders($titulo='noTitle',$return = false){
        ob_start();
?>
<head>
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport"
            content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo ucfirst(strtolower($titulo)) ?></title>
    <!-- BOOTSTRAP -->
    <link  rel="stylesheet"  href="?requestType=reqview&path=node_modules/bootstrap/dist/css/bootstrap.css">
    <script type="text/javascript" src="?requestType=reqview&path=node_modules/bootstrap/dist/js/bootstrap.js"></script>
    
    <!-- JQUERY -->
    <script type="text/javascript" src="?requestType=reqview&path=node_modules/jquery/dist/jquery.js"></script>
    <!-- JQUERY MASK -->
    <script type="text/javascript" src="?requestType=reqview&path=node_modules/jquery-mask-plugin/dist/jquery.mask.js"></script>
    <!--SWAL-->
    <script type="text/javascript" src="?requestType=reqview&path=node_modules/sweetalert/dist/sweetalert.min.js"></script>
</head>
<?php
        $head = ob_get_clean();
        if($return){
            return $head;
        }
        echo $head;
    }
}