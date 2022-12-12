function save(elem){
  let id = elem.nextElementSibling.getAttribute('value');
  console.log(id);
  axios.get('api-save.php',{ params: { idPost: id } }).then(response => {
    //console.log(response);
    if(response.data["saved"]){
      //console.log(id);   
      elem.setAttribute('src', 'upload/webpageIcons/save_checked.svg');
    }else{
      //console.log(id);
      elem.setAttribute('src', 'upload/webpageIcons/save.svg');
    }
  });
}