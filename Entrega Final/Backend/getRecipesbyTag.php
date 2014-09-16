<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

$tag = $_POST('tag');
$tag = "rico";

     mysql_connect("mysql14.000webhost.com", "a1935071_ek", "Moviles2014") or  die("No se pudo conectar: " . mysql_error());
     mysql_select_db("a1935071_ek");
       
     $result = mysql_query("SELECT `idtags` FROM `tags` WHERE `tag` = '$tag'");
      
     $InfoRecipe["recipes"]= array();
     $idTags = array(); 
     $contador = 0;
     while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {     
           $idTags[$contador] = $row["idtags"];   
           $contador++;          
     }
     
     $idRecipes = array();
     $contadorRecipexTag = 0;
     foreach ($idTags as $id_value){
         $RecipexTagQuery = mysql_query("SELECT `recipe_idrecipe` FROM `recipe_has_tags` WHERE `tags_idtags` = '$id_value'");
         while($row = mysql_fetch_array($RecipexTagQuery , MYSQL_ASSOC)) {     
           $idRecipes[$contadorRecipexTag] = $row["recipe_idrecipe"];   
           $contadorRecipexTag++;          
         }
     }
     
     
     foreach ($idRecipes as $id_value){
         $RecipeQuery = mysql_query("SELECT * FROM `recipe` WHERE `idrecipe` = '$id_value'");
         while($row = mysql_fetch_array($RecipeQuery , MYSQL_ASSOC)) {     
           $Receta = array();    
           $Receta["id"] = $row["idrecipe"];       
           $Receta["name"] = $row["nombre"];
           $Receta["description"] = $row["duracion"];
           $Receta["level"] = $row["nivel"];
           array_push($InfoRecipe["recipes"], $Receta);
         
         }
     }
     
      
     mysql_free_result($result);

     echo json_encode($InfoRecipe);

?>