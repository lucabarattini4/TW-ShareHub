function generaBarraUtente(){ //img profilo + nome


}

function generaRisultati(results, ){
  console.log(results);
  if(results.length > 0 && results!="ERR"){
    for(let i=0; i < results.length; i++){
      let res = " ";
      if(results[i]['codUtente'] !=results[i]['sessionIdUtente']){
        res = `<p>${results[i]['testo']}</p><br><p>${results[i]['dataMessaggio']}</p>`;
      }else
      {
        res = `<p style="text-align: right">${results[i]['testo']}</p><br><p style="text-align: right">${results[i]['dataMessaggio']}</p>`;
      }

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

function requestResult(val){
  const formData = new FormData();
  formData.append('chat',val);
  axios.post('api-chat.php', formData).then(response => {
    generaRisultati(response.data);
  });
}

const main = document.querySelector("main");
generaBarraUtente();
var chat = 2;/*id della chat*/
requestResult(chat);
