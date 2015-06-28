$(document).ready(function(){

  // Mobile accordion
  $('.mobile-accordion-toggle').on('click',function() {
    $(this).parents('.mobile-accordion-item').eq(0)
           .toggleClass('opened');
  });

  // Slider --------------
  $('.product-detail-a-slider').slick({
    arrows: false,
    draggable: false,
    touchMove: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    fade: true,
    onInit: function() {
      var slider = $('.product-detail-a-slider');
      $('.slick-dots button',slider).each(function(i){
        var thumbHref = slider.find('.slide').eq(i)
                                .children('img')
                                  .data('thumb');
        $(this).css('background','url('+thumbHref+')')
               .parent('li')
                .addClass('with-thumb');
      });
    }
  });

});
