function openMenu(){
    document.getElementById("menu-logo-fechar").style.width = "100%";
}

function closeMenu(){
    document.getElementById("menu-logo-fechar").style.width = "0%";
}


const swiper = new Swiper('.swiper', {
    // Optional parameters
    loop: true,

    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
      clickable: true,
    },

    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
});



var swiper2 = new Swiper(".mySwiper", {
  slidesPerView: 1,
  spaceBetween: 10,
  loop:true,
  breakpoints: {
    "@0.00": {
      slidesPerView: 1,
      spaceBetween: 10,
    },
    "@0.75": {
      slidesPerView: 1,
      spaceBetween: 20,
    },
    "@1.00": {
      slidesPerView: 3,
      spaceBetween: 40,
     
    },
    "@1.50": {
      slidesPerView: 4,
      spaceBetween: 50,
    },
  },
});

new Glide(".images",{
  type:'carousel',
  perView: 4,
  focusAt: 'center',
  gap: 40,
  breakpoints: {
    1200:{
      perView: 3
    },
    800:{
      perView: 2
    },
    500:{
      perView: 1
  }
}

}).mount();