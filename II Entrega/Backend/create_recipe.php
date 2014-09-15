<?php

$nombreReceta= $_POST['nombreReceta'];
$descripcionReceta= $_POST['descripcionReceta'];
$duracionReceta= $_POST['duracionReceta'];
$nivelReceta = $_POST['nivelReceta'];
$etiquetas = $_POST['etiquetas'];
$procedimiento = $_POST['pasos'];
$ingredientes = $_POST['ingredientes'];

$arrayTags = explode(",", $etiquetas);
$arrayPasos = explode(",", $procedimiento);
$arrayIngredientes = explode(",",$ingredientes);



require_once 'Funciones.php';
$db = new Funciones();

        if($db->addRecipe($nombreReceta,$descripcionReceta,$duracionReceta,$nivelReceta, $arrayTags,$arrayPasos,$arrayIngredientes)){ 
                  $resultado[]=array("addstatus"=>"1");
        }else{
         // failed to insert row
            
                 $resultado[]=array("addstatus"=>"0");
        } 
        // echoing JSON response
    		
        echo json_encode($resultado); 
?>
			