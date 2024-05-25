const toggler = document.querySelector("#toggle-btn");
toggler.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("expand");
});