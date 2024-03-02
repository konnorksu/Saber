console.log('loading')

var w = parseInt(window.innerWidth); 
 

if (w<480) { 
    document.body.classList.add('mobile');
    let burger = document.querySelector('.burger');
    burger.addEventListener('click', function(e){
        document.querySelector('.menu').classList.toggle('act');
    });

} else {
    document.body.classList.add('pc');
}

if ((w<1100) && (w>480)) { 
    document.body.classList.remove('pc');
    document.body.classList.remove('mobile');
    document.body.classList.add('plans');
}

var url = document.location.href;
$.each($("#menu a"),function(){
     if(this.href==url){
        $(this).addClass('active');
     }
});

let offset = 0;
const sliderLine = document.querySelector('.slider-line');

document.querySelector('.slider-next').addEventListener('click', function() {
    offset = offset + 256;
    if (offset > 768) {
        offset = 0;
    }
    sliderLine.style.left = -offset + 'px';
});

document.querySelector('.slider-pred').addEventListener('click', function () {
    offset = offset - 256;
    if (offset < 0) {
        offset = 768;
    }
    sliderLine.style.left = -offset + 'px';
});
