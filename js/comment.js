let allBtn2 = document.querySelectorAll("article > div:nth-child(4) > div:nth-child(3) > a > img");

for (i of allBtn2){
  let clicked = false;

  i.addEventListener("click", function (event) {
    clicked = !clicked;
    let elem = this.parentElement.parentElement.parentElement.parentElement.querySelector("article > div:nth-child(5)");
    event.preventDefault();
    if(clicked){
      elem.style.display="inline-block";
      //console.log("commenti");
      let id = this.nextElementSibling.getAttribute('value');
      let user = this.nextElementSibling.nextElementSibling.getAttribute('value');
      axios.get('api-comment.php',{ params: { idPost: id, idUtente: user } }).then(response => {
        //console.log(response);
        console.log(id);

        console.log(elem);
        visualizzaCommenti(elem, response.data["comments"], id, user);
      });
    }else{
      //UNCLICK
      console.log("unclick");
      elem.style.display="none";
    }
    
  });
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
  console.log(commenti);
  let form = generaFormCommento(id);
  console.log(form);
  commenti += form;
  console.log(main);
  main.innerHTML = commenti;
  main.querySelector("form").addEventListener("submit", function (event) {
    event.preventDefault();
    const testo = document.querySelector("#commento").value;
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
    console.log("Sto commentando");
    axios.post('api-comment.php', formData).then(response => {
        console.log(response.data["commentoInserito"]);
        axios.get('api-comment.php',{ params: { idPost: id, idUtente: username } }).then(response => {
          //console.log(response);
          console.log(id);
  
          console.log(main);
          visualizzaCommenti(main, response.data["comments"], id, username);
        });
    });
}
