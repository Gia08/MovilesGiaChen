var ingredientes= "";
var procedimientos = "";
var cantidadPasos = 1;

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
    ingredientes += "<div class=\"row\">";
    ingredientes += "<div class=\"col-md-1\"><input id=\"cantIngredienteId\" type=\"text\" class=\"form-control\" placeholder=\"Cantidad\"></div>";
    ingredientes += "<div class=\"col-md-2\"><input id=\"unidadIngredienteId\" type=\"text\" class=\"form-control\" placeholder=\"Unidad\"></div>";
    ingredientes += "<div class=\"col-md-3\"><input id=\"nombreIngredienteId\" type=\"text\" class=\"form-control\" placeholder=\"Nombre\"></div>";
    ingredientes += "</div>";
    ingredientes += "<p>&nbsp;</p>";
    $("#componenteIngrediente").html(ingredientes);
}

function guardarReceta() {
    ingredientes = "";
    procedimientos = "";
    cantidadPasos = 1;
}

function agregarProcedimiento() {
    procedimientos += "<div class=\"row\">";
    procedimientos += "<div class=\"col-md-1\"><p>Paso " + cantidadPasos + "</p></div>";
    procedimientos += "<div class=\"col-md-5\"><input id=\"descripcionPasoId\" type=\"text\" class=\"form-control\" placeholder=\"Descripcion\"></div>";
    procedimientos += "</div>";
    procedimientos += "<p>&nbsp;</p>";
    $("#componenteProcedimiento").html(procedimientos);
    cantidadPasos++;
}

function cancelar() {
    location.href = "Lista_Recetas.html";
}