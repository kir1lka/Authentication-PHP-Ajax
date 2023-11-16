const BtnRegist = document.getElementById("btn-regist");
const messageEl = document.getElementById("message");

//function ajax
function makeAjaxRequest(url, method, data) {
  let formData = new FormData();

  for (let key in data) {
    formData.append(key, data[key]);
  }

  let options = {
    method,
    body: formData,
  };

  return fetch(url, options)
    .then((response) => {
      if (!response.ok) {
        throw new Error(
          `Network response was not ok, status: ${response.status}`
        );
      }
      return response.json();
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

///////////////////////
//regist
///////////////////////

BtnRegist.onclick = (e) => {
  e.preventDefault();

  // clear border error inputs
  const inputElements = document.querySelectorAll("input");
  inputElements.forEach((inputEl) => {
    inputEl.classList.remove("error");
  });

  let full_name = document.querySelector('[name="full_name"]').value;
  let login = document.querySelector('[name="login"]').value;
  let photo = document.querySelector('[name="photo"]').files[0];
  let email = document.querySelector('[name="email"]').value;
  let password = document.querySelector('[name="password"]').value;
  let password_confirm = document.querySelector(
    '[name="password_confirm"]'
  ).value;

  let data = {
    full_name,
    login,
    photo,
    email,
    password,
    password_confirm,
  };

  makeAjaxRequest("vendor/signUp.php", "POST", data).then((response) => {
    // user created successfully
    if (response.status) {
      document.location.href = "/index.php";
    }
    // user not created
    else {
      if (response.type) {
        response.fields.forEach((field) => {
          let inputEl = document.querySelector(`[name="${field}"]`);
          inputEl.classList.add("error");
        });
      }

      messageEl.innerHTML = response.message;
      if (response.message !== "") messageEl.style.opacity = 1;
      else messageEl.style.opacity = 0;
    }
  });
};
