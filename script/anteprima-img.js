const chooseFile = document.getElementById("fileToUpload");
const imgPreview = document.getElementById("img-preview");
const btn = document.getElementById("rmv");

const altImg = document.getElementById("descrizioneimmagine");
const label = document.getElementById("labelDescrizione");

chooseFile.addEventListener("change", function () {
  getImgData();
});

function getImgData() {
  const files = chooseFile.files[0];
  if (files) {
    altImg.style.display = "block";
    label.style.display = "block";

    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }else{
    altImg.style.display = "none";
    label.style.display = "none";
  }  
}

btn.onclick = function() { 
  var file = chooseFile;
  if(file.value!=""){
    document.querySelectorAll("form").forEach(e => e.querySelector("img").remove());
  }
  altImg.style.display = "none";
  label.style.display = "none";
  file.value = file.defaultValue;
}

