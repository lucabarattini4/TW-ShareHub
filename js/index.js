function generaPosts(posts){

  for(let i=0; i < posts.length; i++){
    arr.push(posts[i]['idPost']);
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
      <div class="row w-75 pb-3 like">

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
      <div class="row share" style="display: none" class="">
        <div class="col">
          <label for="link${posts[i]['idPost']}" hidden>Link</label>
          <input type="text" id="link${posts[i]['idPost']}" value="localhost/TW-ShareHub/post.php?username=${posts[i]['username']}&idPost=${posts[i]['idPost']}" disabled>
          <button>Copia Link</button>
        </div>
      </div>



      <!--riga sezione commenti + form-->
      <div class="row"></div>`;

      if(posts[i]["idUtente"] == posts[i]["sessionIdUtente"] && getPageName().startsWith("profilo.php")){
        post+=`<div class="row trash">
        <div class="col"><img src="./upload/webpageIcons/trash.svg" alt="elimina post"/>
        <input type="hidden" value="${posts[i]['idPost']}"/></div>
        </div>`;
      }

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


    if(posts[i]["idUtente"] == posts[i]["sessionIdUtente"] && getPageName().startsWith("profilo.php")){
      art.querySelector("div:nth-child(8) > div:nth-child(1) img").addEventListener("click", event => deletePost(event));
    }

    main.appendChild(art);

  }
}

function requestPost(){
  const postNotIncluded = new FormData();
  postNotIncluded.append('arr', JSON.stringify(arr));
  axios.post('api-post.php', postNotIncluded).then(response => {
    //console.log(response);
    generaPosts(response.data);
  });
}

function requestUserPost(){
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const arr1 = new FormData();
  arr1.append('arr', JSON.stringify(arr));
  const user = urlParams.get('user');
  arr1.append('user', user);


  axios.post('api-post.php', arr1).then(response => {
    //console.log(response.data);
    generaPosts(response.data);
  });
}

function requestUserInfo(param){
  axios.get('api-userInfo.php',{ params: { user: param } }).then(response => {
    //console.log(response.data);
    createProfileHeader(response.data);
  });
}

function createProfileHeader(param){
  let info = `<div class="row ">
    <div class="col-12   d-flex justify-content-center">
    <img src="${param[0]['immagineProfilo']}" alt="immagineProfilo"/>
    </div>
    </div>
    <div class="row ">
    <div class="col-12">
      <h2>${param[0]['username']}</h2>
    </div>
    </div>
    <div class="row friends">
    <div class="col-12">
    <p><a href="./followers.php?user=${param[0]['username']}&tipo=follower">FOLLOWERS: ${param[0]['followers']}</a></p>
    </div>
    <div class="col-12">
    <p><a href="./followers.php?user=${param[0]['username']}&tipo=followed">FOLLOWED: ${param[0]['followed']}</a></p>
    </div>
    </div>`;
  if(!param[0]['isCurrentUser']){
    info += `<div class="row">
      <div class="col-md-3"></div>
      <div class="col-3 d-flex align-items-center follow">
      <button  id="follow" type="button">`;
      if(param[0]['isFollowed']){
        info+= `<img   src="./upload/webpageIcons/user-check.svg" alt="is followed"/>`;
      }else{
        info+= `<img  src="./upload/webpageIcons/user-plus.svg" alt="Follow"/>`;
      }
      info+= `</button>
      </div>
      </div>`;
  }

  const f = document.createElement("section");
  f.innerHTML = info;

  if(!param[0]['isCurrentUser']){
    f.querySelector("div:nth-child(4) > div:nth-child(2) button").addEventListener("click", event => follow(event));
  }
  main.appendChild(f);
}

function deletePost(event){
  event.preventDefault();
  //console.log("elimina");
  codPost = event.target.nextElementSibling.getAttribute('value');
  const dataPost = new FormData();
  dataPost.append('idPost', codPost);
  axios.post('api-remove-post.php', dataPost).then(response => {
    //console.log(response.data);
    window.location.reload();
  });
}

function getPageName(){
  let url2 = location.href;
  let urlFileName2 = url2.substring(url2.lastIndexOf('/')+1);
  return urlFileName2;
}

// sleep time expects milliseconds
function sleep (time) {
  return new Promise((resolve) => setTimeout(resolve, time));
}


const arr = [0];
const main = document.querySelector("main");
let param = new URLSearchParams(window.location.search).get('user');

if(getPageName().startsWith("profilo.php")){
  requestUserInfo(param);
  sleep(75).then(() => {
    requestUserPost();
  })
}else{
  requestPost();
}

window.onscroll = function () {
  if(window.onscroll && ((window.innerHeight + window.scrollY) >= document.body.offsetHeight)){
    //console.log("fine pagina");
    if(getPageName().startsWith("profilo.php")){
      requestUserPost();
    }else{
      requestPost();
    }
  }
}
