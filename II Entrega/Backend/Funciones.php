<?php

class Funciones{

     function __construct() {            
       
     }

     function __destruct() {}

    /**
   * Verifica si el usuario existe.
   */
   public function agregarReceta($nombreReceta, $descripcionReceta, $duracionReceta, $etiquetas, $ingredientes, $procedimiento, $imagenReceta){
          
   }
    

   public function addRecipe($nombreReceta,$descripcionReceta,$duracionReceta,$nivelReceta,$arrayTags,$arrayPasos, $arrayIngredientes){
      
      $mysql_host = "mysql8.000webhost.com"; 
      $mysql_database = "a8526269_ek"; 
      $mysql_user = "a8526269_ek"; 
      $mysql_password = "Moviles2014";
      
      $link = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database); 

      if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
      }
      
      $result= $link->prepare("INSERT INTO recipe(nombre,descripcion,duracion,nivel) VALUES (?,?,?,?)");
      $result->bind_param('ssss', $nombreReceta, $descripcionReceta, $duracionReceta, $nivelReceta);
      $result->execute();
      $idRecipe = $link->insert_id;
   
      //check for successful store
      if ($result) { 
           foreach ($arrayTags as $tagValue){
              $resultTags= $link->prepare("INSERT INTO tags (tag) VALUES (?)");
              $resultTags->bind_param('s', $tagValue);
              $resultTags->execute();
              $idTag = $link->insert_id;
              if ($resultTags){
                  $statTagxRecipe= $link->prepare("INSERT INTO recipe_has_tags (recipe_idrecipe,tags_idtags) VALUES (?,?)");
                  $statTagxRecipe->bind_param('ii', $idRecipe, $idTag);
                  $statTagxRecipe->execute(); 
              }
           }
           foreach ($arrayPasos as $pasoValue){
              $resultPasos= $link->prepare("INSERT INTO procedimiento (descripcion) VALUES (?)");
              $resultPasos->bind_param('s', $pasoValue);
              $resultPasos->execute();
              $idPaso = $link->insert_id;
              if ($resultPasos){
                  $statPasoxRecipe= $link->prepare("INSERT INTO recipe_has_procedimiento (recipe_idrecipe,procedimiento_idprocedimiento) VALUES (?,?)");
                  $statPasoxRecipe->bind_param('ii', $idRecipe, $idPaso);
                  $statPasoxRecipe->execute(); 
              }
           }
           foreach ($arrayIngredientes as $ingredienteValue){
              $resultIngrediente = $link->prepare("INSERT INTO ingredient(descripcion) VALUES (?)");
              $resultIngrediente->bind_param('s', $ingredienteValue);
              $resultIngrediente->execute();
              $idIngrediente = $link->insert_id;
              if ($resultIngrediente){
                  $statIngredientxRecipe= $link->prepare("INSERT INTO recipe_has_ingredient (recipe_idrecipe,ingredient_idingredient) VALUES (?,?)");
                  $statIngredientxRecipe->bind_param('ii', $idRecipe, $idIngrediente);
                  $statIngredientxRecipe->execute(); 
              }
           }
        $statIngredientxRecipe->close();
        $statPasoxRecipe->close();
        $statTagxRecipe->close();
        $result->close();
        $link->close();
        $resultTags->close();  
        return true;
      }
      else{
        $result->close();
        $link->close();
        return false;
      }
   }

    
   public function getByTag($nombreTag)
   {
      $mysql_host = "mysql8.000webhost.com"; 
      $mysql_database = "a8526269_ek"; 
      $mysql_user = "a8526269_ek"; 
      $mysql_password = "Moviles2014";

      $link = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database);

      if(mysqli_connect_errno())
      {
          echo "Failed to connect to MySql : " . mysqli_connect_error(); 
      }

     $result= $link->prepare("SELECT * FROM recipe");
     //$result->bind_param('s', $nombreTag);
     $result->execute();

     while($row = mysqli_fetch_array($result)) {
        
       //$json_object = Array('nombre' => $row['nombre'], 'descripcion' => $row['descripcion'],'duracion' => $row['duracion'],);
     }

      //check for successful store
      
        return $json_object;
      
      $result->close();
      $link->close();

   } 
}
?>																							