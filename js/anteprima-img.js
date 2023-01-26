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
    if(altImg){
      altImg.style.display = "block";
      label.style.display = "block";
    }

    const fileReader = new FileReader();
    fileReader.readAsDataURL(files);
    fileReader.addEventListener("load", function () {
      imgPreview.style.display = "block";
      imgPreview.innerHTML = '<img src="' + this.result + '" />';
    });    
  }else{
    if(altImg){
      altImg.style.display = "none";
      label.style.display = "none";
    }
    removeImg();
  }  
}

btn.onclick = function() { 
  let file = chooseFile;
  if(file.value!=""){
    removeImg();
  }
  if(altImg){
    altImg.style.display = "none";
    label.style.display = "none";
  }
  file.value = file.defaultValue;
}

function removeImg(){
  document.getElementById("img-preview").firstChild.remove();
}


