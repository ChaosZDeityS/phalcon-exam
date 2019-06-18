function validatenumerics(key) {
    //getting key code of pressed key
    var keycode = (key.which) ? key.which : key.keyCode;
    //comparing pressed keycodes

    if (keycode > 31 && (keycode < 48 || keycode > 57)) {

        return false;
    }
    else return true;


}



var y = document.getElementById("Note");
y.type= "hidden";


var a = document.getElementById("Photo");
a.type= "hidden";


var a = document.getElementById("Phone");
a.type= "hidden";


var a = document.getElementById("Email");
a.type= "hidden";

var b = document.getElementById("PrefixNameID");
b.style.display = 'none' ;


var x = document.getElementById("Note");
x.style.display ="none" ;

var x = document.getElementById("Address");
x.style.display ="none" ;
