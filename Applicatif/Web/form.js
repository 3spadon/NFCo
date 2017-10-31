function checkFormCreerCours(){
  document.location.href="addCoursDB.php";
}

function checkboxClasseEntiere(){
  var checked = document.getElementById('classeEntiere').checked;
  if(checked==true){
    document.getElementById("selectTDTP").innerHTML = '';
  }
  else{
    var tdtpHTMLcode = "TD <SELECT  name='TD' size='1' class='selectTDTP'><OPTION>1<OPTION>2<OPTION>3<OPTION>4</select> TP <SELECT  name='TP' size='1' class='selectTDTP'><OPTION>1<OPTION>2<OPTION>3<OPTION>4</select><br>";
    document.getElementById("selectTDTP").innerHTML = tdtpHTMLcode;
  }
}
