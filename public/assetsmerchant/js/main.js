// ========== CHECKBOXES FUNCTION

let main_checkbox = document.querySelector(".main_checkbox")
let fm_checkbox = document.querySelector(".activer_from_checkbox")

var checkboxes = document.querySelectorAll(".ascheck");

function checkActiver(myCheckS){
    if(myCheckS.checked == true){
        checkboxes.forEach(function(){
          fm_checkbox.style.display = "block"
        });
    }
    else{
        checkboxes.forEach(function(){
          fm_checkbox.style.display = "none"
        });
    }
}

function checkAll(myCheckbox){
    if(myCheckbox.checked == true){
        checkboxes.forEach(function(checkbox){
            checkbox.checked = true;
            fm_checkbox.style.display = "block"
        });
    }
    else{
        checkboxes.forEach(function(checkbox){
            checkbox.checked = false;
            fm_checkbox.style.display = "none"
        });
    }
}



// PAGE
let filter = document.querySelector(".filter")
let filtered_section = document.querySelector(".filtered_section")

filter.addEventListener("click", ()=>{
    filtered_section.classList.toggle("actived_so")
})


let droper = document.querySelector(".droper")
let dropdown_menu = document.querySelector(".dropdown-menu")

droper.addEventListener("click", ()=>{
    dropdown_menu.classList.toggle("dropdown_active")
    type_download.classList.remove("active_download")
})

let accepte_ = document.querySelector(".accepte_")
let type_download = document.querySelector(".type_download")

accepte_.addEventListener("click", ()=>{
    type_download.classList.toggle("active_download")
})


