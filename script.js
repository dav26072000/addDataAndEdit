const inputElements = document.querySelectorAll(".inputElement");
const submitButton = document.querySelector(".submit");
const form = document.querySelector(".form");

inputElements.forEach((element) => {
  element.addEventListener("focusout", inputChange);
});

submitButton.addEventListener("click", () => {
  let isError = false;
  inputElements.forEach((element) => {
    if (!inputFieldsValidation(element)) {
      isError = true;
    }
  });

  if (!isError) {
    form.submit();
  }
});

function inputChange() {
  inputFieldsValidation(this);
}

// all fields validation
function inputFieldsValidation(element) {
  if (
    element.name === "firstName" ||
    element.name === "lastName" ||
    element.name === "date"
  ) {
    if (element.value.length === 0) {
      error(element);
      return false;
    }
    unError(element);
    return true;
  }

  if (element.name === "email") {
    if (!validateEmail(element.value)) {
      error(element);
      return false;
    }
    unError(element);
    return true;
  }

  if (element.name === "phoneNumber") {
    if (!validatePhone(element.value)) {
      error(element);
      return false;
    }
    unError(element);
    return true;
  }
}

// email validation
function validateEmail(emailAdress) {
  const regexEmail = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;

  if (emailAdress.match(regexEmail)) {
    return true;
  } else {
    return false;
  }
}

// phone validation
function validatePhone(phoneNumber) {
  const regexPhone =
    /^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{3,6}$/im;

  if (phoneNumber.match(regexPhone)) {
    return true;
  } else {
    return false;
  }
}

// error and unError
function error(element) {
  element.classList.add("error-input");
}

function unError(element) {
  element.classList.remove("error-input");
}

// edit
function editRow(index) {
  document.querySelector(`#editButton${index}`).style.display = "none";
  document.querySelector(`#saveButton${index}`).style.display = "inline";

  const firstName = document.querySelector(`#firstName${index}`);
  const lastName = document.querySelector(`#lastName${index}`);
  const date = document.querySelector(`#date${index}`);
  const email = document.querySelector(`#email${index}`);
  const phoneNumber = document.querySelector(`#phoneNumber${index}`);

  const firstNameValue = firstName.innerHTML.trim();
  const lastNameValue = lastName.innerHTML.trim();
  const dateValue = date.innerHTML.trim();
  const emailValue = email.innerHTML.trim();
  const phoneNumberValue = phoneNumber.innerHTML.trim();

  const inputStyle =
    "shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline";

  firstName.innerHTML = `<input type='text' name='firstName' id='firstNameInput${index}' class='${inputStyle}' value='${firstNameValue}'>`;
  lastName.innerHTML = `<input type='text' name='lastName' id='lastNameInput${index}' class='${inputStyle}' value='${lastNameValue}'>`;
  date.innerHTML = `<input type='date' name='date' id='dateInput${index}' class='${inputStyle}' value='${dateValue}'>`;
  email.innerHTML = `<input type='email' name='email' id='emailInput${index}' class='${inputStyle}' value='${emailValue}'>`;
  phoneNumber.innerHTML = `<input type='tel' name='phoneNumber' id='phoneNumberInput${index}' class='${inputStyle}' value='${phoneNumberValue}'>`;
}

// save edited

function saveRow(index) {
  const firstName = document.querySelector(`#firstNameInput${index}`);
  const lastName = document.querySelector(`#lastNameInput${index}`);
  const date = document.querySelector(`#dateInput${index}`);
  const email = document.querySelector(`#emailInput${index}`);
  const phoneNumber = document.querySelector(`#phoneNumberInput${index}`);

  const firstNameRow = document.querySelector(`#firstName${index}`);
  const lastNameRow = document.querySelector(`#lastName${index}`);
  const dateRow = document.querySelector(`#date${index}`);
  const emailRow = document.querySelector(`#email${index}`);
  const phoneNumberRow = document.querySelector(`#phoneNumber${index}`);

  let inputsArr = [firstName, lastName, email, date, phoneNumber];

  //   fields validation
  let isOk = true;
  inputsArr.forEach((element) => {
    if (!inputFieldsValidation(element)) {
      isOk = false;
    }
  });

  if (!isOk) {
    return false;
  }
  //

  const data = {
    id: index,
    firstName: firstName.value,
    lastName: lastName.value,
    date: date.value,
    email: email.value,
    phoneNumber: phoneNumber.value,
  };

  // make XMLHttpRequest
  let request = new XMLHttpRequest();
  request.open("POST", "edit.php", true);
  request.setRequestHeader("Content-Type", "application/json");
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(request.responseText);
      if (response) {
        firstNameRow.innerHTML = data.firstName;
        lastNameRow.innerHTML = data.lastName;
        dateRow.innerHTML = data.date;
        emailRow.innerHTML = data.email;
        phoneNumberRow.innerHTML = data.phoneNumber;

        document.querySelector(`#editButton${index}`).style.display = "inline";
        document.querySelector(`#saveButton${index}`).style.display = "none";
      }
    }
  };
  request.send(JSON.stringify(data));
}

// delete row

function deleteRow(index) {
  const data = {
    id: index,
  };

  const row = document.querySelector(`#row${index}`);

  let request = new XMLHttpRequest();
  request.open("POST", "delete.php", true);
  request.setRequestHeader("Content-Type", "application/json");
  request.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      let response = JSON.parse(request.responseText);
      if (response) {
        row.remove();
      }
    }
  };
  request.send(JSON.stringify(data));
}
