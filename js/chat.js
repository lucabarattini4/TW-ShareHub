function generaBarraUtente(results, ){ //img profilo + nome
  const main = document.querySelector("main");

  if(results.length > 0 && results!="ERR"){
    for(let i=0; i < results.length; i++){

      let res = `

          <!--colonna vuota-->
          <div class="col-md-2"></div>

          <!--colonna immagine profilo-->
          <div class="col-2 d-flex justify-content-center">

              <img src="./upload/profile/${results[i]['immagineProfilo']}" alt="immagine profilo di ${results[i]['immagineProfilo']}"/>

          </div>
          <!--colonna nome utente-->
          <div class="col-10 col-md-6 d-flex align-items-center">

              <h2>${results[i]['username']}</h2>

          `;


      const divBox = document.createElement("div");
      divBox.className = "row";
      divBox.innerHTML = res;
      main.appendChild(divBox);
    }
  }else{
    let msg = `Nessun messaggio trovato`
    const err = document.createElement("p");
    err.className = "error";
    err.innerHTML = msg;
    main.appendChild(err);
  }

}

function generaBarraScrittura(id, chat){



      let res = `
      <form action="#" method="POST" class="msg">
        <label for="messaggio" hidden>Messaggio:</label>
        <input type="text" placeholder="messaggio" id="messaggio" name="messaggio"  class="col-10 "required/>
        <label for="IdChat" hidden>IdChat:</label>
        <input type="hidden" id="idChat" name="idChat" value="${id}" />
        <label for="idUtente" hidden>idUtente:</label>
        <input type="hidden" id="idUtente" name="idUtente" value="${chat}" />
        <input type="submit" name="submit" value="Invia"/>
      </form>`;



      return res;



}

function generaRisultati(results, id){
  (results);
   const main = document.querySelector("main");

  if(results.length > 0 && results!="ERR"){
    for(let i=0; i < results.length; i++){
      let res = " ";
      if(results[i]['codUtente'] !=results[i]['sessionIdUtente']){
        res = `<p>${results[i]['testo']}</p><br><p>${results[i]['dataMessaggio']}</p>`;
      }else
      {
        res = `<p style="text-align: right">${results[i]['testo']}</p><br><p style="text-align: right">${results[i]['dataMessaggio']}</p>`;
      }
      (results.length);
      if( i +1 == results.length ){

          res += generaBarraScrittura(id, results[i]['sessionIdUtente']);

      }
      window.scrollTo(0, document.body.scrollHeight);
      const divBox = document.createElement("div");
      divBox.className = "row";
      divBox.innerHTML = res;

      main.appendChild(divBox);
      if( i +1 == results.length ){

        main.querySelector("main div form").addEventListener("submit", function (event) {
          event.preventDefault();
          const testo = main.querySelector("main div form #messaggio").value;
          console.log(testo);
          console.log(id);
          console.log( results[i]['sessionIdUtente']);
          messaggio(testo, id, results[i]['sessionIdUtente']);
      });

      }

    }
  }else{
    let msg = `Nessun messaggio trovato`;
    msg += generaBarraScrittura(id, getCookie("id"));
    ("TEST  id chat: "+id);
    ("TEST  id user: "+getCookie("id"));
    const err = document.createElement("div");

    err.className = "error";
    err.innerHTML = msg;
    main.appendChild(err);


      main.querySelector("main div form").addEventListener("submit", function (event) {
        event.preventDefault();
        const testo = main.querySelector("main div form #messaggio").value;
        messaggio(testo, id,getCookie("id"));
    });

  }
}
function requestIdChat(user,friend){
  const formData = new FormData();
  formData.append('user', user);
  formData.append('friend', friend);
  axios.post('api-idchat.php', formData).then(response => {


      //for(let i=0; i < response.data.length; i++){

        requestResult(response.data[0]['idChat']);

    //  }

  });
}
function requestResult(val){
  const formData = new FormData();


  formData.append('chat',val);
  axios.post('api-chat.php', formData).then(response => {
    generaRisultati(response.data, val);
  });
}

function requestUser(val){
  const formData = new FormData();
  formData.append('user',val);
  axios.post('api-user.php', formData).then(response => {
    generaBarraUtente(response.data);
  });
}


function messaggio(testo, id, username){
  const formData = new FormData();
  formData.append('testo', testo);
  formData.append('idChat', id);
  formData.append('idUtente', username);
  axios.post('api-chat.php', formData).then(response => {
    axios.get('api-chat.php',{ params: { idChat: id, idUtente: username } }).then(response => {

      refresh();

    });
  });
}


const main = document.querySelector("main");
const urlParams = new URLSearchParams(document.URL);
const pippo = urlParams.get("idChat");
refresh()
//setInterval(refresh, 10000);



function refresh(){

  document.querySelector("main").innerHTML = "";
  let chat = 2;/*id della chat*/
  let friend = getCookie("user");
  let idUser =getCookie("id");


  requestUser(friend)
  requestIdChat(idUser,friend);


}

function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
