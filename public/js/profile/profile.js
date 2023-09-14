function editable($p,$id) {
	var s=document.getElementById($p);
	if(s.hidden==true){
		s.hidden=false;
	}
	else{
		s.hidden=true;
	}
	var x=document.getElementsByClassName($id);
	for (var i = 0; i <x.length; i++)
	{

		x[i].disabled = false;

	}

}
function profilechange($id) {
	var i = document.getElementById($id);
	if (i.hidden == true)
		i.hidden = false;
	else
		i.hidden = true;
}