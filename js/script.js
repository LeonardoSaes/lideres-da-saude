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

$('#numero-participantes').mask('(00) 00000-0000');
$('#numero-patrocinador').mask('(00) 00000-0000');

$('#cpf-participantes').mask('000.000.000-00', {reverse: true});
$('#cpf-patrocinador').mask('000.000.000-00', {reverse: true});
