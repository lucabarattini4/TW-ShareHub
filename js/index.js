function generaPosts(posts){
  let result = "";

  for(let i=0; i < posts.length; i++){
    let post = `
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
      <!--riga data del post-->
      <div class="row">
        <div class="col-12 d-flex justify-content-center align-items-center">
          <p>${posts[i]['dataPost']}</p>
        </div>
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
          post+=`<img src="./upload/webpageIcons/heart.svg" alt="like al post di ${posts[i]['username']}"/>`;
        }else{
          post+=`<img src="./upload/webpageIcons/heart_checked.svg" alt="like al post di ${posts[i]['username']}"/>`;
        }

        post+=`
          <input type="hidden" value="${posts[i]['idPost']}"/>
        </div>

        <!--colonna commenti-->
        <div class="col">
          <img src="./upload/webpageIcons/comment.svg" alt="commenta il post di ${posts[i]['username']}"/>
          <input type="hidden" value="${posts[i]['idPost']}"/>
          <input type="hidden" value="${posts[i]['sessionIdUtente']}"/>
        </div>

        <!--colonna save-->
        <div class="col">`;

        if(posts[i]['isSaved']==false){
          post+=`<img src="./upload/webpageIcons/save.svg" alt="salva il post di ${posts[i]['username']}"/>`;
        }else{
          post+=`<img src="./upload/webpageIcons/save_checked.svg" alt="salva il post di ${posts[i]['username']}"/>`;
        }
        post+=`
          <input type="hidden" value="${posts[i]['idPost']}"/>
        </div>

        <!--colonna condividi-->
        <div class="col">
        <img src="./upload/webpageIcons/share.svg" alt="condividi il post di ${posts[i]['username']}"/></button>
        </div>

        <!--colonna vuota-->
        <div class="col"></div>

      </div>

      <!--riga condividi-->
      <div class="row" style="display: none">
        <div class="col">
          <label for="link${posts[i]['idPost']}" hidden>Link</label>
          <input type="text" id="link${posts[i]['idPost']}" value="localhost/TW-ShareHub/post.php?username=${posts[i]['username']}&idPost=${posts[i]['idPost']}" disabled>
          <button>Copia Link</button>
        </div>
      </div>
      
      <!--riga sezione commenti + form-->
      <div class="row"></div>`;

    const art = document.createElement("article");
    art.innerHTML = post;

    /*aggiungo eventListener per il like */
    art.querySelector("div:nth-child(5) > div:nth-child(2) img").addEventListener("click", event => like(event));

    /*aggiungo eventListener per il save*/
    art.querySelector("div:nth-child(5) > div:nth-child(4) img").addEventListener("click", event => save(event));

    /*aggiungo eventListener per i commenti*/
    art.querySelector("div:nth-child(5) > div:nth-child(3) img").addEventListener("click", event => comment(event));

    /*aggiungo eventListener per il condividi post */
    art.querySelector("div:nth-child(5) > div:nth-child(5) img").addEventListener("click", event => sharePost(event));

    art.querySelector("div:nth-child(6) button").addEventListener("click", event => copyLink(event));

    main.appendChild(art);

  }
}

function requestPost(){
  axios.get('api-post.php').then(response => {
    //console.log(response);
    generaPosts(response.data);
  });
}

function requestUserPost(){
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  let user = urlParams.get('user');
  axios.get('api-post.php',{ params: { user: user } }).then(response => {
    console.log(response.data);
    generaPosts(response.data);
  });
}

function requestUserInfo(param){
  axios.get('api-userInfo.php',{ params: { user: param } }).then(response => {
    console.log("fsdfdsf");
    console.log(response.data);
    createProfileHeader(response.data);
  });
}

function createProfileHeader(param){
  let info = "";
  if(param[0]['isCurrentUser'] == "true"){
    info = `<div class="row ">
    <div class="col-12   d-flex justify-content-center">
      <img src="${param[0]['immagineProfilo']}" alt="immagineProfilo"/>
    </div>
  </div>
  <div class="row ">
      <div class="col-12  r">
        <h2>${param[0]['username']}</h2>
      </div>
  </div>`;
  }else{
    info = `<div class="row ">
    <div class="col-12   d-flex justify-content-center">
      <img src="${param[0]['immagineProfilo']}" alt="immagineProfilo"/>
    </div>
  </div>
  <div class="row ">
      <div class="col-12  r">
        <h2>${param[0]['username']}</h2>
      </div>
  </div>
  <div class="row">
      <div class="col-md-3"></div>
    <div class="col-3 d-flex align-items-center">
        <button  id="follow" type="button"><img src="./upload/webpageIcons/user-plus.svg" alt="Follow"/></button>
    </div>
    <div class="col-3  d-flex align-items-center">
        <a href="#"><img src="./upload/webpageIcons/paper-plane.svg" alt="messaggio"/></a>
    </div>
    <div class="col-3  d-flex align-items-center">
        <a href="#"><img src="./upload/webpageIcons/report.svg" alt="report"/></a>
    </div>
    
  </div>`;
  }

  const f = document.createElement("section");
  f.innerHTML = info;
  main.appendChild(f);
}

let url2 = location.href;
let urlFileName2 = url2.substring(url2.lastIndexOf('/')+1);
const main = document.querySelector("main");
let param = new URLSearchParams(window.location.search).get('user');

if(urlFileName2.startsWith("profilo.php")){
  requestUserInfo(param);
}

console.log("RICHIESTA POST");
if(urlFileName2.startsWith("profilo.php")){
  requestUserPost();
}else{
  requestPost();
}

window.onscroll = function () {
  if(window.onscroll && ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)){
    console.log("fine pagina");
    
    if(urlFileName2.startsWith("profilo.php")){
      requestUserPost();
    }else{
      requestPost();
    }
  }
}