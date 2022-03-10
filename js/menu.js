function myFunction() {
    var x = document.getElementById("myTopnav");
    if (x.className === "topnav") {
      x.className += " responsive";
      document.getElementById('nav-icon').className = "fas fa-times";
    } else {
      x.className = "topnav";
      document.getElementById('nav-icon').className = "fa fa-bars";
    }
  }
  
  