<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$idRecipe = $_POST('idRecipe');
//$idRecipe = 5;

     mysql_connect("mysql14.000webhost.com", "a1935071_ek", "Moviles2014") or  die("No se pudo conectar: " . mysql_error());
     mysql_select_db("a1935071_ek");
       
     $tagsQuery = mysql_query("SELECT tags_idtags FROM recipe_has_tags WHERE recipe_idrecipe=". $idRecipe);   
     $idTags = array();
     $contador = 0;
     while($row = mysql_fetch_array($tagsQuery, MYSQL_ASSOC)) {  
           $idTags[$contador] = $row['tags_idtags'];
           $contador++;
     }
     foreach ($idTags as $id_value){ 
            //$tagQuery = mysql_query("DELETE FROM tags where idtags=". $id_value);
     }
     $TagsxRecipe= mysql_query("DELETE FROM recipe_has_tags WHERE recipe_idrecipe=". $idRecipe); 

     $StepsQuery = mysql_query("SELECT procedimiento_idprocedimiento FROM  recipe_has_procedimiento WHERE recipe_idrecipe=". $idRecipe);   
     $idSteps = array();
     $contadorSteps = 0;
     while($row = mysql_fetch_array($StepsQuery , MYSQL_ASSOC)) {  
           $idSteps[$contadorSteps] = $row['procedimiento_idprocedimiento'];
           $contadorSteps++;
     }     
     foreach ($idSteps as $id_value){ 
            $StepQuery = mysql_query("DELETE FROM procedimiento where idprocedimiento=". $id_value);
     }
     $StepsxRecipe= mysql_query("DELETE FROM recipe_has_procedimiento WHERE recipe_idrecipe=". $idRecipe); 

     foreach ($idTags as $id_value){ 
            $tagQuery = mysql_query("DELETE FROM tags where idtags=". $id_value);
     }

     $IngredientesQuery = mysql_query("SELECT ingredient_idingredient FROM  recipe_has_ingredient WHERE recipe_idrecipe=".$idRecipe);   
     $idIngredientes = array();
     $contadorIngrediente = 0;
     while($row = mysql_fetch_array($IngredientesQuery , MYSQL_ASSOC)) {  
           $idIngredientes[$contadorIngrediente] = $row['ingredient_idingredient'];
           $contadorIngrediente++;
     }     
     foreach ($idIngredientes as $id_value){ 
            $IngredienteQuery = mysql_query("DELETE FROM ingredient where idingredient=". $id_value);
     }
     $IngredientexRecipe= mysql_query("DELETE FROM recipe_has_ingredient WHERE recipe_idrecipe=". $idRecipe); 

     
     $UserxRecipe= mysql_query("DELETE FROM recipe_has_user WHERE recipe_idrecipe=". $idRecipe); 

     $Recipe= mysql_query("DELETE FROM recipe WHERE idrecipe=". $idRecipe); 

     echo json_encode("Se ha eliminado la receta con exito!");
?>