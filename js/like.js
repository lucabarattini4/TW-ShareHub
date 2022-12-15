function like(event){
  let id = event.target.nextElementSibling.getAttribute('value');
  console.log(id);
  axios.get('api-like.php',{ params: { idPost: id } }).then(response => {
    if(response.data["liked"]){
      event.target.setAttribute('src', 'upload/webpageIcons/heart_checked.svg');
    }else{
      event.target.setAttribute('src', 'upload/webpageIcons/heart.svg');
    }
  });
}