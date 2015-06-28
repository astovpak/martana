$(document).ready(function(){

  // Slider --------------

  $('.elibrary-books-slider').slick({
    arrows: true,
    draggable: false,
    touchMove: false,
    adaptiveHeight: true,
    slidesToShow: 5,
    slidesToScroll: 1,
    responsive: [
      {
        breakpoint: 640,
        settings: {
          touchMove: false,
          slidesToShow: 1
        }
      }
    ]
  });

});
