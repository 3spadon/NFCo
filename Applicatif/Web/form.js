var pseudo = document.getElementById('login');
var motdepasse = document.getElementById('password');

function check(){
  var pseudo = document.getElementById('login');
  var motdepasse = document.getElementById('password');
	if(pseudo.value==""){
		pseudo.style.borderColor="red";
	}
  else if(pseudo.value!=""){
		pseudo.style.borderColor="";
	}
  if(motdepasse.value==""){
		motdepasse.style.borderColor="red";
	}
  else if(motdepasse.value!=""){
		motdepasse.style.borderColor="";
	}
}
