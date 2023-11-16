const messageEl = document.getElementById("message");
const BtnLogin = document.getElementById("btn-login");

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
//login
///////////////////////

BtnLogin.onclick = (e) => {
  e.preventDefault();

  //clear border error inputs
  const inputElements = document.querySelectorAll("input");
  inputElements.forEach((inputEl) => {
    inputEl.classList.remove("error");
  });

  let login = document.querySelector('[name="login"]').value;
  let password = document.querySelector('[name="password"]').value;

  makeAjaxRequest("vendor/signIn.php", "POST", { login, password }).then(
    (response) => {
      //user find
      if (response.status) {
        document.location.href = "/home.php";
      }
      //user not find
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
    }
  );
};
