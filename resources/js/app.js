import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
])

const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
        if(entry.isIntersecting){
            entry.target.classList.add('showing');
        } else {
            entry.target.classList.remove('showing');
        }
    });
});
const hiddenElements = document.querySelectorAll('.hidden');
hiddenElements.forEach((el) => observer.observe(el));


let myH3 = document.getElementById('jumbo_h3');
let myImg = document.getElementById('propic');

window.addEventListener('scroll', ()=>{
    let value = window.scrollY;
    console.log(value)

    myH3.style.marginTop = value * 2 + 'px';
    myImg.style.marginTop = value * 2 + 'px';
});
