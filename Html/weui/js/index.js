$(function() {
    FastClick.attach(document.body);
});
$("#banner").swiper({
    loop: true,
    autoplay: 3000,
    autoplayDisableOnInteraction : false,
});

$("#category").swiper({
    loop: false,
    autoplay: false,
});