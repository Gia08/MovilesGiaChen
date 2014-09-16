<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

//$idRecipe = $_POST('idRecipe');
$idRecipe = 3;
     mysql_connect("mysql14.000webhost.com", "a1935071_ek", "Moviles2014") or  die("No se pudo conectar: " . mysql_error());
     mysql_select_db("a1935071_ek");
       
     $result = mysql_query("SELECT * FROM recipe where idRecipe=". $idRecipe);
      
     $InfoRecipe["recipe"]= array();

      while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
  
           $Receta = array();           
           $Receta["name"] = $row["nombre"];
           $Receta["description"] = $row["duracion"];
           $Receta["level"] = $row["nivel"];    
           
           $userxrecipe = mysql_query("SELECT user_iduser FROM recipe_has_user where recipe_idrecipe=". $idRecipe);
           if ($row = mysql_fetch_array($userxrecipe, MYSQL_ASSOC)) {
                 $userid = $row["user_iduser"];
           }

           $user = mysql_query("SELECT * FROM user where iduser=". $userid);
           if ($row = mysql_fetch_array($user, MYSQL_ASSOC)) {
                 $Receta["userName"] = $row["name"];
                 $Receta["userEmail"] = $row["email"];
           }  
           
           $idIngrediente = array(); 
           $contador = 0;
           $ingredientxrecipe = mysql_query("SELECT ingredient_idingredient FROM  recipe_has_ingredient where recipe_idrecipe=". $idRecipe);
           while ($row = mysql_fetch_array($ingredientxrecipe , MYSQL_ASSOC)) {
                  $idIngrediente[$contador] = $row["ingredient_idingredient"];
                  $contador++;
           }
           
           $Ingredientes = array();
           $contadorIngredientes = 0;
           foreach ($idIngrediente as $id_value){ 
                 $ingredientQuery = mysql_query("SELECT * FROM ingredient where idingredient=". $id_value);
                 while ($row = mysql_fetch_array($ingredientQuery, MYSQL_ASSOC)) {
                     $Ingredientes[$contadorIngredientes] =  $row["descripcion"];
                     $contadorIngredientes ++;
                     
                 }
           }

           $idSteps= array(); 
           $contador = 0;
           $stepxrecipe = mysql_query("SELECT procedimiento_idprocedimiento FROM  recipe_has_procedimiento where recipe_idrecipe=". $idRecipe);
           while ($row = mysql_fetch_array($stepxrecipe , MYSQL_ASSOC)) {
                  $idSteps[$contador] = $row["procedimiento_idprocedimiento"];
                  $contador++;
           }
           
           $Steps= array();
           $contadorSteps = 0;
           foreach ($idSteps as $id_value){ 
                 $stepQuery = mysql_query("SELECT * FROM procedimiento where idprocedimiento=". $id_value);
                 while ($row = mysql_fetch_array($stepQuery , MYSQL_ASSOC)) {
                     $Steps[$contadorSteps ] =  $row["descripcion"];
                     $contadorSteps ++;
                     
                 }
           }

           $idTags= array(); 
           $contador = 0;
           $tagxrecipe = mysql_query("SELECT tags_idtags FROM  recipe_has_tags where recipe_idrecipe=". $idRecipe);
           while ($row = mysql_fetch_array($tagxrecipe , MYSQL_ASSOC)) {
                  $idTags[$contador] = $row["tags_idtags"];
                  $contador++;
           }
           
           $Tags= array();
           $contadorTags = 0;
           foreach ($idTags as $id_value){ 
                 $tagQuery = mysql_query("SELECT * FROM tags where idtags=". $id_value);
                 while ($row = mysql_fetch_array($tagQuery , MYSQL_ASSOC)) {
                     $Tags[$contadorTags] =  $row["tag"];
                     $contadorTags++;
                     
                 }
           }   
           $Receta["etiquetas"] = $Tags;         
           $Receta["ingredientes"] = $Ingredientes;
           $Receta["pasos"] = $Steps;
           array_push($InfoRecipe["recipe"], $Receta); 
           //$stepsxrecipe = mysql_query("SELECT procedimiento_idprocedimiento FROM recipe_has_procedimiento where recipe_idrecipe=". $idRecipe);
           //while ($row = mysql_fetch_array($stepsxrecipe, MYSQL_ASSOC)) {
           //      $idStep = $row['procedimiento_idprocedimiento'];

           //      $step= mysql_query("SELECT description FROM procedimiento where idprocedimiento=". $idStep);
           //      if ($row = mysql_fetch_array($ingredient, MYSQL_ASSOC)) {
           //           $Steps= array();
           //           $Steps["descripcion"] =  $row["description"];
           //      }
           // }
           
                       
       
      }
      
     mysql_free_result($result);
     echo json_encode($InfoRecipe);

?>