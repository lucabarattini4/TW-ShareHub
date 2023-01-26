function generaBarraDiRicerca(){
  let bar = `<h2 class="text-center">Cerca</h2>
  <input type="search" class="form-control" name="search" id="search" placeholder="Search Users">`;

  const searchBar = document.createElement("form");
  searchBar.innerHTML = bar;
  /**disabilita l'invio della ricerca */
  searchBar.addEventListener("submit", function(event){
    event.preventDefault();
    return false;
  });
  main.appendChild(searchBar);
}

function generaRisultati(results){
  let elemExist = main.querySelectorAll("div.user");
  let errExist = main.querySelectorAll("p.error");
  if( elemExist){
    elemExist.forEach(e => e.remove())
  }
  if(errExist){
    errExist.forEach(e => e.remove())
  }
  if(results.length > 0 && results!="ERR"){
    for(let i=0; i < results.length; i++){
      let res = `<button class="results" role="link"><img src="${results[i]['immagineProfilo']}" alt="immagine profilo di ${results[i]['username']}"\><p>${results[i]['username']}</p></button>`;
      const divBox = document.createElement("div");
      divBox.className = "user row";
      divBox.innerHTML = res;
      divBox.querySelector("button").addEventListener("click", function(event){
        event.preventDefault();
        main.querySelector("input").value = "";
        window.location.href = "./profilo.php?user="+results[i]['username'];
      })
      main.appendChild(divBox);
    }
  }else{
    let msg = `Nessun utente trovato...`
    const err = document.createElement("p");
    err.className = "error";
    err.innerHTML = msg;
    main.appendChild(err);
  }
}

function requestResult(val){
  const formData = new FormData();
  formData.append('search', val);
  axios.post('api-search.php', formData).then(response => {
    generaRisultati(response.data);
  });
}

const main = document.querySelector("main");
generaBarraDiRicerca();


$(document).ready(function(){
  $("#search").on("keyup", function(){
    let search = $(this).val();
    requestResult(search);
  });
});
