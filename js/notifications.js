function generaNotifiche(notifications){
  const mainNotifiche = document.querySelector("main");
  for(let i=0; i < notifications.length; i++){

    let notifica = `<div class="row ">

    <div class="col-md-2"></div>
  
    <!--colonna immagine profilo-->
    <div class="col-2 d-flex justify-content-center">
      img profilo
    </div>
  
    <!--colonna nome utente-->
    <div class="col-10 col-md-6 d-flex align-items-center">
      <a href="./messages.php">
        <p>${notifications[i]['descrizioneNotifica']}</p>
      </a>
    </div>
  
    <div class="col-md-2"></div>
  
    </div>`;
    //

    const sec = document.createElement("section");
    sec.innerHTML = notifica;
    mainNotifiche.appendChild(sec);
    console.log(mainNotifiche);
  }
     
}

function richiediNotifiche(){
  axios.get('api-notifications.php').then(response => {
    //console.log(response.data);
    generaNotifiche(response.data.notifications);
  });
}

function richiediNumeroNuoveNotifiche(){
  axios.get('api-notifications.php').then(response => {
    let s = document.querySelector("footer span");
    s.innerHTML = response.data.newNotificationsNumber;
  });
}

let url = location.href;
let urlFileName = url.substring(url.lastIndexOf('/')+1);

if(urlFileName == "notifications.php"){
  richiediNotifiche();
}

setInterval(richiediNumeroNuoveNotifiche, 500);
