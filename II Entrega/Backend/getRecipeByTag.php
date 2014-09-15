<?php

$nombreTag= $_GET['nombreTag'];

require_once 'Funciones.php';
$db = new Funciones();

        //if($db->getByTag($nombreTag)){ 
                        
                  $resultado[]= $db->getByTag($nombreTag);
        //}else{
         // failed to insert row
            
         //         $resultado[]=array("addstatus"=>"0");
         //} 
        // echoing JSON response
    		
        echo json_encode($resultado);  
?>