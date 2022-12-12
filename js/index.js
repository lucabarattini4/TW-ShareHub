function generaPosts(posts){
  let result = "";

  for(let i=0; i < posts.length; i++){
    let post = `
    <article>
      <!--riga img profilo + nome utente -->
      <div class="row ">

        <!--colonna vuota-->
        <div class="col-md-2"></div>

        <!--colonna immagine profilo-->
        <div class="col-2 d-flex justify-content-center">
          <a href="./profilo.php?user=${posts[i]['username']}">
            <img src="${posts[i]['immagineProfilo']}" alt="immagine profilo di ${posts[i]['immagineProfilo']}"/>
          </a>
        </div>

        <!--colonna nome utente-->
        <div class="col-10 col-md-6 d-flex align-items-center">
          <a href="./profilo.php?user=${posts[i]['username']}">
            <h2>${posts[i]['username']}</h2>
          </a>
        </div>

        <!--colonna vuota-->
        <div class="col-md-2"></div>

      </div>

      <!--riga testo del post-->
      <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
          <p>${posts[i]['testo']}</p>
        </div>
      </div>`;

      let img = posts[i]['immagine'].split('/').pop();
      if(img != ""){
        post += `<!--riga eventuale immagine-->
        <div class="row">
          <div class="col d-flex justify-content-center">
            <img src="${posts[i]['immagine']}" alt="${posts[i]["descImmagine"]}" />
          </div>
        </div>`;
      }else{
        post+=`<!--riga eventuale immagine-->
            <div class="row"></div>`;
      }

     post+=`
      <!--riga mi piace, commenti, save-->
      <div class="row w-75 pb-3">

        <!--colonna vuota-->
        <div class="col-md-3"></div>

        <!--colonna mi piace-->
        <div class="col">`;

        if(posts[i]['isLiked']==false){
          post+=`<img src="./upload/webpageIcons/heart.svg" alt="like al post di ${posts[i]['username']}" onclick="like(this)"/>`;
        }else{
          post+=`<img src="./upload/webpageIcons/heart_checked.svg" alt="like al post di ${posts[i]['username']}" onclick="like(this)"/>`;
        }
        
        post+=`
          <input type="hidden" value="${posts[i]['idPost']}"/>
        </div>

        <!--colonna commenti-->
        <div class="col">
          <img src="./upload/webpageIcons/comment.svg" alt="commenta il post di ${posts[i]['username']}" onclick="comment(this)"/>
          <input type="hidden" value="${posts[i]['idPost']}"/>
          <input type="hidden" value="${posts[i]['sessionIdUtente']}"/>
        </div>

        <!--colonna save-->
        <div class="col">`;

        if(posts[i]['isSaved']==false){
          post+=`<img src="./upload/webpageIcons/save.svg" alt="salva il post di ${posts[i]['username']}" onclick="save(this)"/>`;
        }else{
          post+=`<img src="./upload/webpageIcons/save_checked.svg" alt="salva il post di ${posts[i]['username']}" onclick="save(this)"/>`;
        }
        post+=`
          <input type="hidden" value="${posts[i]['idPost']}"/>
        </div>

        <!--colonna condividi-->
        <div class="col">
          <img src="./upload/webpageIcons/share.svg" alt="condividi il post di ${posts[i]['username']}"/>
        </div>

        <!--colonna vuota-->
        <div class="col"></div>

      </div>

      <!--riga sezione commenti + form-->
      <div class="row" style="display: none"></div>

    </article>`;
    result += post;
  }
  return result;
}

function requestPost(){
  axios.get('api-post.php').then(response => {
    //console.log(response);
    main.innerHTML += generaPosts(response.data);
  });
}

const main = document.querySelector("main");

console.log("RICHIESTA POST");
requestPost();


window.onscroll = function() {
  if(window.onscroll && ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)){
    console.log("fine pagina");
    requestPost();
  }
}