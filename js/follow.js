function follow(event){
  event.preventDefault();
  //console.log("SEGUI");
  let username = event.target.parentElement.parentElement.parentElement.parentElement.querySelector("div:nth-child(2) h2").innerHTML;
  axios.get('api-follow.php',{ params: { user: username } }).then(response => {
    //console.log(response.data["followed"]);
    if(response.data["followed"]){
      event.target.setAttribute('src', 'upload/webpageIcons/user-check.svg');
    }else{
      event.target.setAttribute('src', 'upload/webpageIcons/user-plus.svg');
    }
  });
}