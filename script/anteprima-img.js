const chooseFile = document.getElementById("fileToUpload");
const imgPreview = document.getElementById("img-preview");
const btn = document.getElementById("rmv");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
    imgPreview.style.display = "block";
    imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }  
}

btn.onclick = function() { 
  var file = chooseFile;
  if(file.value!=""){
    document.querySelectorAll("form").forEach(e => e.querySelector("img").remove());
  }
  file.value = file.defaultValue;
}

