<?php

class Functions{

    function __construct() {
      
    }

    function __destruct() {}

    
   /**
   * Verifica si el usuario existe.
   */
   public function userExist($email){
          
      $mysqli = new mysqli("mysql14.000webhost.com",  "a1935071_ek", "Moviles2014", "a1935071_ek");

            /* check connection */

            if (mysqli_connect_errno()) {
                 printf("Connect failed: %s\n", mysqli_connect_error());
                 exit();
            }
       
       $result= $mysqli->prepare("SELECT email FROM user WHERE email=?");
       $result->bind_param('s', $email);
       $result->execute();

   
    if ($result->fetch()){
            return true;//Ya existe la cuenta
       }
       else{
            return false; // No existe la cuenta
       }
       
       $result->close();
       $mysqli->close();
   }


   public function recipeExist($idRecipe){
          
      $mysqli = new mysqli("mysql14.000webhost.com",  "a1935071_ek", "Moviles2014", "a1935071_ek");

            /* check connection */

            if (mysqli_connect_errno()) {
                 printf("Connect failed: %s\n", mysqli_connect_error());
                 exit();
            }
       
       $result= $mysqli->prepare("SELECT idRecipe FROM recipe WHERE idRecipe=?");
       $result->bind_param('i', $idRecipe);
       $result->execute();
   
    if ($result->fetch()){
            return true;//Si existe la receta
       }
       else{
            return false; //No existe la receta
       }
       
       $result->close();
       $mysqli->close();
   }
  

   public function addUserxRecipe($email, $idRecipe){
          
      $mysqli = new mysqli("mysql14.000webhost.com",  "a1935071_ek", "Moviles2014", "a1935071_ek");

            /* check connection */
            if (mysqli_connect_errno()) {
                 printf("Connect failed: %s\n", mysqli_connect_error());
                 exit();
            }
       
      $result = $mysqli->prepare("SELECT iduser FROM user WHERE email=?");
      $result->bind_param('s', $email);
      $result->execute();
      $result->bind_result($idUser);

      while ($result->fetch())
      {
            $iduserResult= $idUser;
            
      }      
      
      $addRecipexUser =  $mysqli->prepare("INSERT INTO recipe_has_user (recipe_idrecipe, user_iduser) VALUES (?,?)");
      $addRecipexUser->bind_param('ii', $idRecipe, $idUser);
      $addRecipexUser->execute();
      $addRecipexUser->close();
      $result->close();
      $mysqli->close();
   }


   public function LoginUser($name, $email){
      
      $mysql_host = "mysql14.000webhost.com"; 
      $mysql_database = "a1935071_ek"; 
      $mysql_user = "a1935071_ek"; 
      $mysql_password = "Moviles2014";
      
            
      if (!$this->userExist($email)){

            $link = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database); 
      
            if (mysqli_connect_errno()) {
                 echo "Failed to connect to MySQL: " . mysqli_connect_error();
                 return false; 
            }
            else{
                 $result= $link->prepare("INSERT INTO user(name, email) VALUES (?,?)");
                 $result->bind_param('ss', $name, $email);
   
                 $result->execute();
                 $result->close();

            }
            $link->close();
            return true;
       }

       else{

           return false;
       } 
   }

   public function addRecipe($nombreReceta,$descripcionReceta,$duracionReceta,$nivelReceta,$arrayTags,$arrayPasos, $arrayIngredientes, $email){
      
      $mysql_host = "mysql14.000webhost.com"; 
      $mysql_database = "a1935071_ek"; 
      $mysql_user = "a1935071_ek"; 
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
        $this->addUserxRecipe($email, $idRecipe);
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

   
   public function addImage($image){
      
      $mysql_host = "mysql14.000webhost.com"; 
      $mysql_database = "a1935071_ek"; 
      $mysql_user = "a1935071_ek"; 
      $mysql_password = "Moviles2014";
      
      
      $link = new mysqli($mysql_host, $mysql_user, $mysql_password, $mysql_database); 
      
      if (mysqli_connect_errno()) {
          echo "Failed to connect to MySQL: " . mysqli_connect_error();
          return false; 
      }
      else{
          $result= $link->prepare("INSERT INTO image(image) VALUES (?)");
          $result->bind_param('b', $image);
          $result->execute();
          $result->close();
      }
      $link->close();
      return true;
   }

}

?>			