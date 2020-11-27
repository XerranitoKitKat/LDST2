var currentTab = 0;

function mostrarTab(n) {//esta funciona se encarga de la logica para mostrar los botones seguiente, anterior y crear cuenta con coherencia
  var x = document.getElementsByClassName("contenedor");
  x[n].style.display = "block";
  if (n == 0) { //Primera vez que se carga formulario no queremos mostrar boton con opcion anterior
    document.getElementById("prevBtn").style.display = "none";
  } else { //Hemos cambiado de formulario mostramos boton
    document.getElementById("prevBtn").style.display = "inline";
  }
  if (n == (x.length - 1)) { //Estamos en segunda parte del formulario listos para crear cuenta
    document.getElementById("nextBtn").innerHTML = "Crear Cuenta";
  } else { //Estamos en primera parte del formulario mostramos siguiente
    document.getElementById("nextBtn").innerHTML = "Siguiente";
  }
}

function siguienteAnterior(n) {//n va a ser 1 o -1
  var x = document.getElementsByClassName("contenedor");//Cogemos contenedores
  if (n == 1 && !validarForm()) return false; //Verificamos que esté rellenado de forma correcta
  x[currentTab].style.display = "none";//dejamos de mostrar el formulario actual
  currentTab = currentTab + n;//llevamos cuenta de en que parte del formulario estamos
  if (currentTab >= x.length) {//si hemos dado a crear cuenta esto es true
    document.getElementById("formulario").submit();
    return false;
  }
  mostrarTab(currentTab);//mostramos botones correspondientes
}

function validarForm() {//funcion para validación de campos
  var x, y, i, valido = true;
  x = document.getElementsByClassName("contenedor");
  y = x[currentTab].getElementsByTagName("input");
  for (i = 0; i < y.length; i++) {
    if (y[i].value == "") {
      y[i].className += " invalid";
      valido = false;
    }
  }
  return valido;
}
