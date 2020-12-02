function mostrarAsignaturas(curso) {
  if(curso.value=="1") {
    var txt='<label><input type="checkbox" name="algebra">Algebra Lineal</label><br>'+
     '<label><input type="checkbox" name="calculo">Calculo</label><br>'+
     '<label><input type="checkbox" name="cel">Circuitos electricos</label><br>'+
     '<label><input type="checkbox" name="progra">Programacion</label><br>'+
     '<label><input type="checkbox" name="economia">Economia</label><br>'+
     '<label><input type="checkbox" name="fe">Fundamentos de Electronica</label><br>'+
     '<label><input type="checkbox" name="sar">Se&ntildeales Aleatorias y Ruido</label><br>'+
     '<label><input type="checkbox" name="sl">Sistemas Lineales</label><br>'+
     '<label><input type="checkbox" name="fisica">Fisica</label><br>'+
     '<label><input type="checkbox" name="foso">Fundamentos de Ordenadores y Sistemas Operativos</label><br>';

  }
  else if(curso.value=="2") {
    var txt='<label><input type="checkbox" name="ampli">Ampliacion de Matematicas</label><br>'+
     '<label><input type="checkbox" name="tc">Teoria de la Comunicacion</label><br>'+
     '<label><input type="checkbox" name="cea">Circuitos Electronicos Analogicos</label><br>'+
     '<label><input type="checkbox" name="ced">Circuitos Electronicos Digitales</label><br>'+
     '<label><input type="checkbox" name="arss">Arquitectura de Redes, Sistemas y Servicios</label><br>'+
     '<label><input type="checkbox" name="cem">Campos Electromagneticos</label><br>'+
     '<label><input type="checkbox" name="sc">Sistemas de Comunicacion</label><br>'+
     '<label><input type="checkbox" name="iss">Ingenieria de Sistemas Software</label><br>'+
     '<label><input type="checkbox" name="rst">Redes y Servicios Telematicos</label><br>'+
     '<label><input type="checkbox" name="sebm">Sistemas Electronicos Basados en Microprocesador</label><br>';

    }
  else if(curso.value=="3") {
    var txt='<label><input type="checkbox" name="tcg">Teoria de Campos Guiados</label><br>'+
     '<label><input type="checkbox" name="iprt">Ingenieria de Protocolos en Redes Telematicas</label><br>'+
     '<label><input type="checkbox" name="dad">Desarrollo de Aplicaciones Distribuidas</label><br>'+
     '<label><input type="checkbox" name="ssec">Subsistemas Electronicos de Comunicaciones</label><br>'+
     '<label><input type="checkbox" name="ftr">Fundamentos de Transmision por radio</label><br>'+
     '<label><input type="checkbox" name="tds">Tratamiento Digital de la Se&ntildeal</label><br>'+
     '<label><input type="checkbox" name="scg">Sistemas de Comunicaciones Guiadas</label><br>'+
     '<label><input type="checkbox" name="merf">Microelectronica de Radio Frecuencia</label><br>'+
     '<label><input type="checkbox" name="dcdc">Dise&ntildeo de Circuitos Digitales para Comunicaciones</label><br>'+
     '<label><input type="checkbox" name="agrst">Administracióon y Gestion de Redes y Servicios Telematicos</label><br>';
  }

  else if(curso.value=="4") {
    var txt='<label><input type="checkbox" name="mnt">Metodos Numericos en Telecomunicacion</label><br>'+
     '<label><input type="checkbox" name="iee">Instrumentacion y Equipos Electronicos</label><br>'+
     '<label><input type="checkbox" name="fsi">Fundamentos de Sonido e Imagen</label><br>'+
     '<label><input type="checkbox" name="dcic">Dise&ntildeo de Circuitos Integrados para Comunicaciones</label><br>'+
     '<label><input type="checkbox" name="ldst">Laboratorio de Desarrollo de Sistemas Telemáticos</label><br>'+
     '<label><input type="checkbox" name="itrt">Ingenieria de Trafico en Redes Telematicas</label><br>'+
     '<label><input type="checkbox" name="tde">Teoría de la Deteccion y la Estimacion</label><br>'+
     '<label><input type="checkbox" name="sco">Sistemas de Comunicaciones Opticas</label><br>'+
     '<label><input type="checkbox" name="str">Sistemas de Telecomunicación por Radio</label><br>'+
     '<label><input type="checkbox" name="dpse">Desarrollo Practico de Sistemas Electronicos</label><br>';
  }
  else{
  var txt ='';
  }
  document.getElementById("contenedor_asig").innerHTML=txt;


}
