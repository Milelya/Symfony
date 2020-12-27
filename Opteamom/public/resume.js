//
const navBtn=document.querySelector('#navMenu');
const navItem=document.querySelector('#menuItem');


navBtn.addEventListener("click",e=>{
    navItem.classList.toggle('inactive');
})