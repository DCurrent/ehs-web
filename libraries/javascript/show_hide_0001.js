// JavaScript Document

function show_hide(id){ // This gets executed when the user clicks on the checkbox
var obj = document.getElementById(id);

	if (obj.style.display=="none")
	{ // if it is checked, make it visible, if not, hide it
		obj.style.display = "block";
	}
	else
	{
		obj.style.display = "none";
	}
}