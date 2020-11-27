function loadEnlacesXML(){//funcion para realizar la petición AJAX
  var xmlEnlaces = new XMLHttpRequest();
  xmlEnlaces.onreadystatechange = function(){
    if(xmlEnlaces.readyState == 4 && xmlEnlaces.status == 200){
      mostrarEnlaces(xmlEnlaces);
    }
  };
  xmlEnlaces.open("GET", "./enlaces.xml", true);
  xmlEnlaces.send();
}

function mostrarEnlaces(xmlEnlaces){//funcion para mostrar contenido en el documento HTML
  var i;
  var xmlDocumento = xmlEnlaces.responseXML;
  var enlaces = xmlDocumento.getElementsByTagName("enlace");
  var aux = "";

  for(i=0;i<enlaces.length;i++){
    aux += '<div class="elemgrid"><a href="'+enlaces[i].getElementsByTagName("url")[0].innerHTML+
    '">'+enlaces[i].getElementsByTagName("descripcion")[0].innerHTML+'</a></div>';
  }

  document.getElementsByClassName("contenedorgrid")[0].innerHTML = aux;
}
