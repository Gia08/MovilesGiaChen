<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$nombreReceta= $_POST['nombreReceta'];
$descripcionReceta= $_POST['descripcionReceta'];
$duracionReceta= $_POST['duracionReceta'];
$nivelReceta = $_POST['nivelReceta'];
$etiquetas = $_POST['etiquetas'];
$procedimiento = $_POST['pasos'];
$ingredientes = $_POST['ingredientes'];
$email = $_POST['email'];

$arrayTags = explode(",", $etiquetas);
$arrayPasos = explode(",", $procedimiento);
$arrayIngredientes = explode(",",$ingredientes);



require_once 'functions.php';

$db = new Functions();

        if($db->addRecipe($nombreReceta,$descripcionReceta,$duracionReceta,$nivelReceta, $arrayTags,$arrayPasos,$arrayIngredientes,$email)){ 
                   $resultado[]=array("addstatus"=>"Se agrego la receta exitosamente");
        }else{
        // failed to insert row
            
                 $resultado[]=array("addstatus"=>"Ocurrio un error al agregar la receta");
        } 
        // echoing JSON response
    		
        echo json_encode($resultado); 
?>
			