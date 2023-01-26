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
  
  event.preventDefault();

  let element = event.target.parentElement;
  var copyText = element.querySelector("input");


  copyText.select();
  copyText.setSelectionRange(0, 99999);


  navigator.clipboard.writeText(copyText.value);
}
