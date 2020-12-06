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
