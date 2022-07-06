function add() {
let notlogin = document.querySelector(".logo-profile");
if (notlogin){
      let attributes = document.querySelectorAll(".add");
      attributes.forEach((attribute) => {
        attribute.href = "/login.php";
      });
}
}



let state = document.querySelector(".status");
let logout = document.querySelector(".logout");
let login = document.querySelector(".logo-profile-login");
let logined = document.querySelector(".userLogin");
let statusRegister = document.querySelector(".statusRegister");

let user = document.querySelector(".user");
if (login){
  user.innerHTML = "Logout";
  user.href = "/logout.php";
  logined.style = "display : none";
} 

if (user.innerHTML == "Logout"){
  user.addEventListener("click", ()=>{
    alert("Are you sure?");
  })
}



