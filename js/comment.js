let clicked = false;

function comment(event){
  event.preventDefault();
  let elem = event.target.parentElement.parentElement.parentElement.querySelector("article > div:nth-child(5)");
  if(elem.style.display=="inline-block"){
    //nascondi
    elem.style.display="none";
  }else{
    //mostra
    elem.style.display="inline-block";
    let id = event.target.nextElementSibling.getAttribute('value');
    let user = event.target.nextElementSibling.nextElementSibling.getAttribute('value');
    axios.get('api-comment.php',{ params: { idPost: id, idUtente: user } }).then(response => {
      visualizzaCommenti(elem, response.data["comments"], id, user);
    });
  }
}

function generaCommenti(listaCommenti){
  if(listaCommenti.length==0){
    result = `<ul><li>Nessun commento</li></ul>`;
  }else{
    result = `<ul>`
    for (let i = 0; i < listaCommenti.length; i++) {
      result += 
      `<li>
        <h3>${listaCommenti[i]["username"]}</h3>
        <p>${listaCommenti[i]["testo"]}</p>
      </li>`;
     }
     result += `</ul>`;
  }
  return result;
}

function visualizzaCommenti(main, listaCommenti, id, user) {
  let commenti = generaCommenti(listaCommenti);
  let form = generaFormCommento(id);
  commenti += form;
  main.innerHTML = commenti;
  main.querySelector("article form").addEventListener("submit", function (event) {
    event.preventDefault();
    const testo = main.querySelector("article form #commento").value;
    commenta(testo, id, user, main);
});
}

function generaFormCommento(id) {
  let form = `
  <form action="#" method="POST">
    <label for="commento">Commenta:</label>
    <input type="text" placeholder="commento" id="commento" name="commento" required/>
    <input type="hidden" id="idPost" name="idPost" value="${id}" />
    <input type="submit" name="submit" value="Invia"/>
  </form>`;
  return form;
}

function commenta(testo, id, username, main){
  const formData = new FormData();
  formData.append('testo', testo);
  formData.append('idPost', id);
  formData.append('idUtente', username);
  axios.post('api-comment.php', formData).then(response => {
    axios.get('api-comment.php',{ params: { idPost: id, idUtente: username } }).then(response => {
      visualizzaCommenti(main, response.data["comments"], id, username);
    });
  });
}
