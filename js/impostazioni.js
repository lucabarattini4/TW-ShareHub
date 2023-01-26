function generaImpostazioni(){

    let listaImpostazioni = `<div>
    <h1>Impostazioni</h1>
    <ul>
      <li>
        <h2>Cambio nome utente</h2>
        <div style="display:none;"></div>
      </li>
      <li>
        <h2>Cambio password</h2>
        <div style="display:none;"></div>
      </li>
      <li>
        <h2>Cambio dati personali</h2>
        <div style="display:none;"></div>
      </li>
      <li>
        <h2>Logout</h2>
      </li>
    </ul>
    </div>
    `;
    const section = document.createElement("section");
    section.innerHTML = listaImpostazioni;

    section.querySelector("div li:nth-child(1)").addEventListener("click", event => changeUsername(event));

    section.querySelector("div li:nth-child(2)").addEventListener("click", event => changePassword(event));

    section.querySelector("div li:nth-child(3)").addEventListener("click", event => changePersonalData(event));

    /*aggiungo eventListener per il logout */
    section.querySelector("div li:nth-child(4)").addEventListener("click", event => logout(event));

    main.appendChild(section);
}

function showHide(event){
  event.preventDefault();
  let elem = event.target.nextElementSibling;
  if(elem.style.display=="inline-block"){
    elem.style.display="none";
  }else{
    elem.style.display="inline-block";
  }
}

function createChangeUserForm(event){
  let userForm = `<form method="post">
    <input type="text" name="user" id="name" required/>
    <input type="submit" name="submit" value="Cambia"/>
  </form>`;
  event.target.nextElementSibling.innerHTML += userForm;
}

function createChangePassForm(event){
  let userForm = `<form method="post">
    <input type="password" name="oldpsw" id="oldpsw" required/>
    <input type="password" name="newpsw" id="newpsw" required/>
    <input type="submit" name="submit" value="Cambia"/>
  </form>`;
  event.target.nextElementSibling.innerHTML += userForm;
}

function createChangePDForm(event){
  let userForm = `<form method="post">
    <input type="text" name="user" id="name" required/>
    <input type="submit" name="submit" value="Cambia"/>
  </form>`;
  event.target.nextElementSibling.innerHTML += userForm;
}

function changeUsername(event){
  event.preventDefault();
  if(!execUser){
    createChangeUserForm(event);
    execUser = true;
  }
  showHide(event);
}

function changePassword(event){
  event.preventDefault();
  if(!execPass){
    createChangePassForm(event);
    execPass = true;
  }
  showHide(event);
}

function changePersonalData(event){
  event.preventDefault();
  if(!execPD){
    createChangePDForm(event);
    execPD = true;
  }
  showHide(event);
}

function logout(event){
  event.preventDefault();
  const log = new FormData();
  log.append('logout', 'true');
  axios.post('api-impostazioni.php', log).then(response => {
    console.log(response.data);
    window.location.replace("./");
  });
}

let execUser = false;
let execPass = false;
let execPD = false;
const main = document.querySelector("main");
generaImpostazioni();

