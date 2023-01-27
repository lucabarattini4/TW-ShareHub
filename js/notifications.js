function generaNotifiche(notifications){
  const mainNotifiche = document.querySelector("main");
  for(let i=0; i < notifications.length; i++){

    let notifica = `<div class="row ">

    <div class="col-md-1"></div>
  
    <!--colonna-->
    <div class="col-3 d-flex justify-content-center">
    <p class="data">${notifications[i]['dataNotifica']}</p>
    </div>
  
    <!--colonna-->
    <div class="col-7 col-md-6 d-flex align-items-center">
      <input type="hidden" value="${notifications[i]['idNotifica']}"/>
      `;
      
    if(notifications[i].presaVisione == 0){
      notifica += `<p style="font-weight:bold;">${notifications[i]['descrizioneNotifica']}</p>
      </div>`;
    }else{
      notifica += `<p style="font-weight:normal;">${notifications[i]['descrizioneNotifica']}</p>
      </div>`;
    }

  
    if(notifications[i].presaVisione == 0){
      notifica += `<div class="col-2 col-md-2"><img src="./upload/webpageIcons/eye.svg" alt="segna come letto"/></div>`;
    }else{
      notifica += `<div class="col-2 col-md-2"></div>`;
    }
    
  
    notifica += `</div>`;

    const sec = document.createElement("div");
    sec.innerHTML = notifica;

    if(sec.querySelector("div:nth-child(1) > div:nth-child(4) img") != null){
      sec.querySelector("div:nth-child(1) > div:nth-child(4) img").addEventListener("click", event => checkAsRead(event));
    }

    mainNotifiche.appendChild(sec);
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

function checkAsRead(event){
  event.preventDefault();
  let pElem = event.target.parentElement.parentElement.querySelector("div:nth-child(3) p");
  let idN = event.target.parentElement.parentElement.querySelector("div:nth-child(3) input").getAttribute("value");

  const formData = new FormData();
  formData.append('idNotifica', idN);
  axios.post('api-notifications.php', formData).then(response => {
    if(response.data["seen"]){
      pElem.setAttribute("style", "font-weight:bold;");
    }
    pElem.setAttribute("style", "font-weight:normal;");
    event.target.style.display="none";
  });
}

let url = location.href;
let urlFileName = url.substring(url.lastIndexOf('/')+1);

if(urlFileName == "notifications.php"){
  richiediNotifiche();
}

setInterval(richiediNumeroNuoveNotifiche, 500);
