// const toggler = document.querySelector("#toggle-btn");
// toggler.addEventListener("click",function(){
//     document.querySelector("#sidebar").classList.toggle("expand");
// });

// const hamBurger = document.querySelector(".toggle-btn");

// hamBurger.addEventListener("click", function () {
//     document.querySelector("#sidebar").classList.toggle("expand");
// });

const hamBurger = document.querySelector(".toggle-btn");

// Fungsi untuk mengganti status sidebar
function toggleSidebar() {
    const sidebar = document.querySelector("#sidebar");
    sidebar.classList.toggle("expand");
    sidebar.classList.toggle("collapsed");

    // Simpan status ke localStorage
    if (sidebar.classList.contains("expand")) {
        localStorage.setItem("sidebarState", "expanded");
    } else {
        localStorage.setItem("sidebarState", "collapsed");
    }
}

// Event listener untuk tombol hamburger
hamBurger.addEventListener("click", toggleSidebar);

// Setel keadaan awal dari sidebar berdasarkan localStorage
window.addEventListener("load", function () {
    const sidebar = document.querySelector("#sidebar");
    const sidebarState = localStorage.getItem("sidebarState");

    if (sidebarState === "collapsed") {
        sidebar.classList.add("collapsed");
    } else {
        sidebar.classList.add("expand");
    }
});
