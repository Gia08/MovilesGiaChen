<?php


header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$name= $_POST['name'];
$email= $_POST['email'];


require_once 'functions.php';

$db = new Functions();

        if($db->LoginUser($name,$email)){ 
                   $resultado[]=array("addstatus"=>"Se agrego el usuario");
        }else{
        // failed to insert row
            
                 $resultado[]=array("addstatus"=>"Ocurrio un error al agregar el usuario");
        } 
        // echoing JSON response
    		
        echo json_encode($resultado);  

?>		