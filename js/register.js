let error = document.querySelector("#error");

const register = document.getElementById("register");

register.addEventListener("submit", (e) => {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;
  const password_confirmation = document.getElementById("password_confirmation").value;

  e.preventDefault();

  if(password === password_confirmation) {

    let users = JSON.parse(localStorage.getItem("users"));

    const newUser = {
      username,
      password
    };

    if(users) {
      users.user.push(newUser);

      localStorage.setItem("users", JSON.stringify(users));
    } else {
      let users = {};
      let user = [newUser];
      users.user = user;

      localStorage.setItem("users", JSON.stringify(users));
    }

    alert("Register successful. Please login");

    window.location = "login.html";

  } else {
    error.innerHTML = `
    <p class="error">Your password do not match. Try again!</p>
    `;
  }
});
