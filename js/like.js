function like(elem){
  let id = elem.nextElementSibling.getAttribute('value');
  console.log(id);
  axios.get('api-like.php',{ params: { idPost: id } }).then(response => {
    if(response.data["liked"]){
      elem.setAttribute('src', 'upload/webpageIcons/heart_checked.svg');
    }else{
      elem.setAttribute('src', 'upload/webpageIcons/heart.svg');
    }
  });
}