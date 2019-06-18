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

var x = document.getElementById("StudentCode");
x.type= "hidden";

