$(document).ready(function(){

  // Home Sliders --------------
  $('.home-top-slider').slick({
    arrows: true,
    draggable: false,
    touchMove: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true
  });

  $('.home-left-slider, .home-right-slider').slick({
    arrows: true,
    draggable: false,
    touchMove: false,
    slidesToShow: 4,
    slidesToScroll: 4,
    responsive: [
      {
        breakpoint: 640,
        settings: {
          touchMove: false,
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });
});
