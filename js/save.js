let allBtn1 = document.querySelectorAll("article > div:nth-child(4) > div:nth-child(4) > a > img");

for (i of allBtn1){
  console.log(i);
  i.addEventListener("click", function (event) {
    event.preventDefault();
    let id = this.nextElementSibling.getAttribute('value');
    axios.get('api-save.php',{ params: { idPost: id } }).then(response => {
      console.log(response);
      if(response.data["saved"]){
        console.log(id);   
        this.setAttribute('src', 'upload/webpageIcons/save_checked.svg');
      }else{
        console.log(id);
        this.setAttribute('src', 'upload/webpageIcons/save.svg');
      }
    });
  });
}