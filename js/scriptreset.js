// Reset all the input even the user input is echoed by php
function resetForm() {
    let formControl = document.querySelectorAll(".form-control");
    let formSelect = document.querySelectorAll(".form-select");

    formControl.forEach(elm => {
        elm.defaultValue = "";
        elm.value = elm.defaultValue;
    });
    formSelect.forEach(elm => {
        elm.selectedIndex = 0;
    });
}