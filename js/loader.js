window.addEventListener("load", function () {
    var loader = document.getElementById("loader");
    var preloader = document.getElementById("preloader");
    loader.style.opacity = 0;
    setTimeout(function() {
      preloader.style.opacity = 0;
      setTimeout(function() {
        preloader.style.display = "none";
        preloader.classList.add('.navbar'); 
      }, 600);
    }, 1000);
  });
window.addEventListener("load", function () {
    var loader = document.getElementById("loader");
    var preloader = document.getElementById("preloader");
    setTimeout(function() {
      loader.style.display = "none";
      preloader.style.display = "none";
    }, 2000); 
});