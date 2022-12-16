/*$(document).ready(function(){
  $("#search").on("keyup", function(){
  
  var search = $(this).val();
  console.log(search);
  if (search !=="") {
  $.ajax({
  url:"api-search.php",
  type:"POST",
  cache:false,
  data:{term:search},
  success:function(data){
  $("#search-result").html(data);
  $("#search-result").fadeIn();
  }  
  });
  }else{
  $("#search-result").html("");  
  $("#search-result").fadeOut();
  }
  });
  // click one particular search name it's fill in textbox
  $(document).on("click","li", function(){
  $('#search').val($(this).text());
  $('#search-result').fadeOut("fast");
  });
  });*/

  function generaBarra(){
    let bar = `<h2 class="text-center">Cerca</h2>
    <input type="search" class="form-control" name="search" id="search" placeholder="Search Users">`;

    const searchBar = document.createElement("form");
    searchBar.innerHTML = bar;
    main.appendChild(searchBar);
  }

  function autocomplete(event, val){
    event.preventDefault();
    document.querySelector("input").value = val;
  }

  function generaRisultati(results){
    let elemExist = main.querySelectorAll("div.user");
    let errExist = main.querySelectorAll("p.error");
    if(  elemExist ){
      elemExist.forEach(e => e.remove())
    }
    if( errExist ){
      errExist.forEach(e => e.remove())
    }
    //main.querySelector()
    if(results.length > 0 && results!="ERR"){
      for(let i=0; i < results.length; i++){
        let res = `<img src="${results[i]['immagineProfilo']}" width="50px" height="50px" alt="immagine profilo di ${results[i]['username']}"\> <p>${results[i]['username']}</p>`;
        console.log("res"+res);
    
        const divBox = document.createElement("div");
        divBox.className = "user";
        divBox.innerHTML = res;
    
        /*aggiungo eventListener per il like */
        divBox.addEventListener("click", event => autocomplete(event, results[i]['username']));
  
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
    axios.get('api-search.php', { params: { search: val } }).then(response => {
      generaRisultati(response.data);
    });
  }
  
  const main = document.querySelector("main");
  generaBarra();


  $(document).ready(function(){
    $("#search").on("keyup", function(){
    var search = $(this).val();
    requestResult(search);
    });
  }); 