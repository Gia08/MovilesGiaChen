<?php

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');

     mysql_connect("mysql14.000webhost.com", "a1935071_ek", "Moviles2014") or  die("No se pudo conectar: " . mysql_error());
     mysql_select_db("a1935071_ek");
       
     $result = mysql_query("SELECT * FROM recipe");
      
     $InfoRecipe["recipes"]= array();

      while($row = mysql_fetch_array($result, MYSQL_ASSOC)) {
  
           $Receta = array();    
           $Receta["id"] = $row["idrecipe"];       
           $Receta["name"] = $row["nombre"];
           $Receta["description"] = $row["duracion"];
           $Receta["level"] = $row["nivel"];
           array_push($InfoRecipe["recipes"], $Receta);
      
      }
      
     mysql_free_result($result);

     echo json_encode($InfoRecipe);

?>