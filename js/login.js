const login = document.getElementById("login");
let error = document.querySelector("#error");

let users = JSON.parse(localStorage.getItem("users"));

login.addEventListener("submit", (e) => {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  e.preventDefault();

  users.user.forEach(i => {
    if(i.username === username && i.password === password) {
      sessionStorage.setItem("auth", true);
      window.location = "todo.html";
    } else {
      error.innerHTML = `
        <p class="error">Your username/password was incorrect. Try again!</p>
      `;
    }
  }) 
}); 