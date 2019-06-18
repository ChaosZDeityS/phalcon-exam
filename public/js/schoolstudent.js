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


var x = document.getElementById("PrefixNameID");
x.style.visibility = 'hidden' ;

var x = document.getElementById("CourseID");
x.style.display = 'none' ;


var x = document.getElementById("Sex");
x.style.display = 'none' ;

var x = document.getElementById("Birthday");
x.style.display = 'none' ;

var y = document.getElementById("FirstNameEn");
y.type= "hidden";

var y = document.getElementById("LastNameEn");
y.type= "hidden";