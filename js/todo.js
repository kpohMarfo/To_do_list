const task = document.querySelector("#task");
let list = document.querySelector("#list");
let error = document.querySelector("#error");

let todo = [];

if(!sessionStorage.getItem("auth")){
  window.location = "login.html";
}

task.addEventListener("keyup", (e) => {
  if(e.keyCode == 13) {
    e.preventDefault();
    add();
  }
});

function print() {
  list.innerHTML = "";

  todo.forEach((i, j) => {
    list.innerHTML += `
    <li class="task">
      <p class="task-list">${i}</p>
      <span onclick="del(${j})" id="${j}" class="delete">X</span>
    </li>
    `
  });
}

function add() {
  if (task.value.length === 0) {
    error.innerHTML = `
    <p class="error">Please input a task</p>
    `
  } else {
    error.innerHTML = "";
    todo.push(task.value);
    print();
  }

  task.value = "";
}

list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

function del(taskId) {
  todo.splice(taskId, 1);
  print();
}

function logout() {
  sessionStorage.clear();
}