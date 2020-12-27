const navModal=document.querySelector('#loginBtn');
const loginForm=document.querySelector('#loginForm');
const createAccountForm=document.querySelector('#createAccountBtn');
const accountForm=document.querySelector('#createAccountForm')

//open login form
navModal.addEventListener('click',function(e){
    loginForm.classList.toggle('login-form'); 
    loginForm.classList.toggle('inactive'); 
    document.querySelector('main').classList.toggle('inactive');
})

////
// On click on background hide the login form 
loginForm.addEventListener('click',function(e){
    loginForm.classList.toggle('login-form'); 
    loginForm.classList.toggle('inactive'); 
    document.querySelector('main').classList.toggle('inactive');
},false)
//Part below to don't hide the form if click on the form itself
loginForm.children[0].addEventListener('click',function(e){
    e.stopPropagation();
},true)
//
////