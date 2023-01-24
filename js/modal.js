function sharePost(event){
  let elem = event.target.parentElement.parentElement.parentElement.querySelector("article > div:nth-child(6)");
  if(elem.style.display=="inline-block"){
    //nascondi
    elem.style.display="none";
  }else{
    //mostra
    elem.style.display="inline-block";
  }
}

function copyLink(event){
  //console.log("ciao mondo");
  event.preventDefault();
  // Get the text field
  let element = event.target.parentElement;
  var copyText = element.querySelector("input");

  // Select the text field
  copyText.select();
  copyText.setSelectionRange(0, 99999); // For mobile devices

  // Copy the text inside the text field
  navigator.clipboard.writeText(copyText.value);
}
