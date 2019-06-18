function validatenumerics(key) {
    //getting key code of pressed key
    var keycode = (key.which) ? key.which : key.keyCode;
    //comparing pressed keycodes

    if (keycode > 31 && (keycode < 48 || keycode > 57)) {

        return false;
    }
    else return true;


}





var z = document.getElementById("StudentCode");
z.disabled = true;
