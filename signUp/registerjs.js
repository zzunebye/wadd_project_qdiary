const firstname = document.getElementById('firstname');
const lastname = document.getElementById('lastname');
const email = document.getElementById('email');
const password = document.getElementById('password');
const password2 = document.getElementById('confirm');
const input = document.querySelectorAll('input');
const submit = document.querySelector('button');

let check_enable1 = false;
let check_enable2 = false;
let check_enable3 = false;
let check_enable4 = false;
let check_enable5 = false;

firstname.addEventListener('change', () => {
  if(firstname.value.length < 1){
    firstname.parentElement.classList.add("error");
    firstname.parentElement.classList.remove("success");
    check_enable1 = false;
    
  }else{
    firstname.parentElement.classList.remove("error");
    firstname.parentElement.classList.add("success");
    check_enable1 = true;
    
  }
})

lastname.addEventListener('change', () => {
  if(lastname.value.length < 1){
    lastname.parentElement.classList.add("error");
    lastname.parentElement.classList.remove("success");
    check_enable2 = false;
  }else{
    lastname.parentElement.classList.remove("error");
    lastname.parentElement.classList.add("success");
    check_enable2 = true;
  }
})

password.addEventListener('change', () => {
  console.log("1");
  if(password.value.length < 6){
    password.parentElement.classList.add("error");
    password.parentElement.classList.remove("success");
    check_enable3 = false;
  }else{
    password.parentElement.classList.remove("error");
    password.parentElement.classList.add("success");
    check_enable3 = true;
  }
})

password2.addEventListener('change', () => {
  if(password.value != password2.value){
    password2.parentElement.classList.add("error");
    password2.parentElement.classList.remove("success");
    check_enable4 = false;
  }else{
    password2.parentElement.classList.remove("error");
    password2.parentElement.classList.add("success");
    check_enable4 = true;
  }
})

email.addEventListener('change', () => {
  const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  if (!re.test(email.value.trim())) {
    email.parentElement.classList.add("error");
    email.parentElement.classList.remove("success");
    check_enable5 = false;
  } else {
    email.parentElement.classList.remove("error");
    email.parentElement.classList.add("success");
    check_enable5 = true;
  }
})

input.forEach(e => {
  e.addEventListener('change', () => {
    if(check_enable1 && check_enable2 && check_enable3 && check_enable4 &&check_enable5){
      submit.classList.remove('unable')
    }else{
      submit.classList.add('unable')
    }
  })
});
