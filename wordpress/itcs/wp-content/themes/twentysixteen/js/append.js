window.setCurrentMenu = function(menuName) {
  $(".nav a[title=" + menuName + "]").parent().addClass("active");
};