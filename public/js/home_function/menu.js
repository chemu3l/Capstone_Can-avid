function openAction(actionType) {
    var i;
    var x = document.getElementsByClassName("actions");
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";
    }
    document.getElementById(actionType).style.display = "block";
}




