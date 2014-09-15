var ingredientes= "";
var procedimientos = "";
var cantidadPasos = 1;
var arrayProcedimiento = new Array();
var arrayIngredientes = new Array();

function nobackbutton() {
    window.location.hash = "no-back-button";
    window.location.hash = "Again-No-back-button" //chrome
    window.onhashchange = function () { window.location.hash = "no-back-button"; }
}

function LoginFb() {
    location.href = "Lista_Recetas.html";
}

function agregarReceta() {
    location.href = "Agregar_Receta.html";
}

function agregarIngrediente() {
    var descripcion = document.getElementById("cantIngredienteId").value + " " + document.getElementById("unidadIngredienteId").value + " " + document.getElementById("nombreIngredienteId").value;
    arrayIngredientes.push(descripcion);
    ingredientes += "<div class=\"row\">";
    ingredientes += "<div class=\"col-md-5\"><p>" +descripcion+"</p></div>";
    ingredientes += "</div>";
    $("#componenteIngrediente").html(ingredientes);
}

function guardarReceta() {
    ajaxAddRecipePost();
    location.href = "Agregar_Receta.html";
}

function agregarProcedimiento() {
    arrayProcedimiento.push(document.getElementById("descripcionPasoId").value);
    procedimientos += "<div class=\"row\">";
    procedimientos += "<div class=\"col-md-1\"><p>Paso " + cantidadPasos + "</p></div>";
    procedimientos += "<div class=\"col-md-5\"><p>"+ document.getElementById("descripcionPasoId").value+"</p></div>";
    procedimientos += "</div>";
    $("#componenteProcedimiento").html(procedimientos);
    cantidadPasos++;
}

function cancelar() {
    location.href = "Lista_Recetas.html";
}

function ajaxRequest() {
    var activexmodes = ["Msxml2.XMLHTTP", "Microsoft.XMLHTTP"]; //activeX versions to check for in IE
    if (window.ActiveXObject) { //Test for support for ActiveXObject in IE first (as XMLHttpRequest in IE7 is broken)
        for (var i = 0; i < activexmodes.length; i++) {
            try {
                return new ActiveXObject(activexmodes[i]);
            }
            catch (e) {
                //suppress error
            }
        }
    }
    else if (window.XMLHttpRequest) // if Mozilla, Safari etc
        return new XMLHttpRequest();
    else
        return false;
}

function ajaxAddRecipePost() {
    var mypostrequest=new ajaxRequest();
    mypostrequest.onreadystatechange=function(){
        if (mypostrequest.readyState==4){
            if (mypostrequest.status==200 || window.location.href.indexOf("http")==-1){
                //document.getElementById("result").innerHTML = mypostrequest.responseText;
                //alert(mypostrequest.responseText);
            }
            else{
                alert("An error has occured making the request");
            }
        }
    }
    
    var name = encodeURIComponent(document.getElementById("nameRecipeId").value);
    var description = encodeURIComponent(document.getElementById("descriptionRecipeId").value);
    var duration = encodeURIComponent(document.getElementById("durationRecipeId").value);
    var nivel = encodeURIComponent(document.getElementById("NivelId").value);
    var arrayTagsGET = document.getElementById("TagsRecipeId").value;
    var arrayTags = arrayTagsGET.split(",");
    var parameters = "nombreReceta=" + name + "&descripcionReceta=" + description + "&duracionReceta=" + duration + "&nivelReceta=" + nivel + "&etiquetas=" + arrayTags + "&pasos=" + arrayProcedimiento + "&ingredientes=" + arrayIngredientes;
    mypostrequest.open("POST", "http://www.easykitchenapp.com/create_recipe.php", true);
    mypostrequest.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    mypostrequest.send(parameters);
}






