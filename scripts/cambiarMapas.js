var mostrandoTeleco=false; /*Declaro esta variable para llevar un control de que imagenes se están mostrando*/

function mostrarPlanosInfo(){
  if (mostrandoTeleco==true) {
    var txt="<div><img src='./images/edificio_baja_info.jpg' alt='Planta baja de informatica' title='Planta baja de informatica'><u>Planta baja</u></div>"+
    "<div><img src='./images/edificio_primera_info.jpg' alt='Primera planta de informatica' title='Primera planta de informatica'><u>Primera planta</u></div>";

    document.getElementsByClassName("contenedorImagenes")[0].innerHTML=txt;
    /*El metodo getElementsByClassName() devuelve una colleción de elementos innerHTML,
    hay que seleccionar uno o bien on el metodo item() o como hago en el código*/
    mostrandoTeleco=false;
  }
}

function mostrarPlanosTeleco(){
  if (mostrandoTeleco==false) {
    var txt="<div><img src='./images/edificio_baja_teleco.jpg' alt='Planta baja de telecomunicaciones' title='Planta baja de telecomunicaciones'><u>Planta baja</u></div>"+
    "<div><img src='./images/edificio_primera_teleco.jpg'alt='Primera planta de telecomunicaciones' title='Primera planta de telecomunicaciones'><u>Primera planta</u></div>"+
    "<div><img src='./images/edificio_segunda_teleco.jpg' alt='Segunda planta de telecomunicaciones' title='Segunda planta de telecomunicaciones'><u>Segunda planta</u></div>";

    document.getElementsByClassName("contenedorImagenes")[0].innerHTML=txt;
    mostrandoTeleco=true;
  }
}
