
// ACCARDION
var acc = document.getElementsByClassName("accordion");

var i;
for (i = 0; i < acc.length; i++) {
    acc[i].addEventListener("click", function () {

        this.classList.toggle("active");

        var panel = this.nextElementSibling;
        if (panel.style.display === "block") {
            panel.style.display = "none";
        } else {
            panel.style.display = "block";
        }
    });
}

let menu = document.querySelector(".menu")
let menu_section = document.querySelector(".menu_section")

menu.onclick = ()=>{
    menu.classList.toggle("active_btn")
    menu_section.classList.toggle("active_menu")
}

