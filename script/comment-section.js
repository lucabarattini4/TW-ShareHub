function comments(name) { 
  console.log(document.getElementById(name));
  var x = name; 
  if (x.style.display === "none") { 
    x.style.display = "block"; 
  } else { 
    x.style.display = "none"; 
  }
} 