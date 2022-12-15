function showModal(event){
  event.preventDefault();
  let article = event.target.parentElement.parentElement.parentElement;
  let modal = article.querySelector("article > div:nth-child(6)");
  modal.style.display = "block";
}

function hideModal(event){
  event.preventDefault();
  let element = event.target.parentElement.parentElement.parentElement;
  element.style.display = "none";
}

function copyLink(event){
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
