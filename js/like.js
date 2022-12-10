let allBtn = document.querySelectorAll("article > div:nth-child(4) > div:nth-child(2) > a > img");

for (i of allBtn){
  i.addEventListener("click", function (event) {
    event.preventDefault();
    let id = this.nextElementSibling.getAttribute('value');
    axios.get('api-like.php',{ params: { idPost: id } }).then(response => {
      //console.log(response);
      if(response.data["liked"]){
        //console.log(id);   
        this.setAttribute('src', 'upload/webpageIcons/heart_checked.svg');
      }else{
        //console.log(id);
        this.setAttribute('src', 'upload/webpageIcons/heart.svg');
      }
    });
  });
}