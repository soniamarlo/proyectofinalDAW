document.addEventListener("DOMContentLoaded", function () {
    // Obtener los elementos input de tipo radio
    var convivenciaSi = document.getElementById("convivencia_mascotas_si");
    var convivenciaNo = document.getElementById("convivencia_mascotas_no");
    var spanOculto = document.getElementById("spanOculto");


    // Agregar un evento change a cada input
    convivenciaSi.addEventListener("change", mostrarSpan);
    convivenciaNo.addEventListener("change", mostrarSpan);


    function mostrarSpan() {
        if (convivenciaSi.checked && convivenciaSi.value === "si") {
            spanOculto.style.display = "inline";
        } else {
            spanOculto.style.display = "none";
        }
    }


});
    
    
    
        

       


