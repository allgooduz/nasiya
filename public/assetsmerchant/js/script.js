

let for_sidebar = document.querySelector(".for_sidebar")
let back_side = document.querySelector(".back_side")
let sidebar = document.querySelector(".sidebar")

for_sidebar.addEventListener("click", ()=>{
    sidebar.classList.add("act_back_side")
    back_side.style.display = "block"
    for_sidebar.style.display = "none"
})
back_side.addEventListener("click", ()=>{
    sidebar.classList.remove("act_back_side")
    back_side.style.display = "none"
    for_sidebar.style.display = "block"
})
