function fechas(Si) {
  if(Si.value=="1") {
    var txt='<label for "Si"> He dado positivo o estoy confinado. </label></br></br>';
  }
  else{
  var txt ='';
  }
  document.getElementById("pos").innerHTML=txt;
}
