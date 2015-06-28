$(document).ready(function(){
// main image changing
$('li.product-color-thumb').click(
       
             function() {
                 $(this).parent().find('.active').removeClass('active');
                 $(this).addClass('active');
                 var src=$(this).find('img').attr('src');
                 $( "div.slide" ).css({backgroundImage:"url("+src+")"}) ;
             }
            );
  // Slider --------------
  var tooltipsterDefaults = {
    contentAsHTML: true,
    touchDevices: false,
    theme: "product-detail-tooltip",
    trigger: "hover",
    content: "<h1>fdgd</h1>"//<img src='images/tmp/product-detail-tooltip1.jpg' width='138' height='138' alt='' />"
  }; // this code as example

  $('.product-detail-a-slider').slick({
    arrows: true,
    draggable: false,
    touchMove: false,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    onInit: function() {
      $('.product-detail-a-slider .slick-dots button').tooltipster(tooltipsterDefaults);
    }
  });

  $('button.tooltipstered').tooltipster({
       contentAsHTML: true,
    touchDevices: false,
    theme: "product-detail-tooltip",
    trigger: "hover"
  });

  // Mobile accordion
  $('.mobile-accordion-toggle').on('click',function() {
    $(this).parents('.mobile-accordion-item').eq(0)
           .toggleClass('opened');
  });

  // Type B Tabs
  $('.product-detail-tabs > li').on('click','a',function(e) {
    e.preventDefault();
    var index = $('.product-detail-tabs > li').index($(this).parent());

    $('.product-detail-a-content').removeClass('active')
                                  .eq(index)
                                    .addClass('active');
    $('.product-detail-tabs > li').removeClass('active')
                                  .eq(index)
                                    .addClass('active');
  });

  // Show more colors
  $('.show-more-colors-link').on('click',function(e) {
    e.preventDefault();
    $(this).hide();
    if ($(window).width() < 640) {
      $('.product-detail-a-more-colors').css('display','inline');
    } else {
      $('.product-detail-a-more-colors').slideDown();
    }
  });

  $(window).on('resize',function() {
    if ($('.mobile').is(':visible')) {
      $('.type-b').addClass('type-b-disabled');
    } else {
      $('.type-b').removeClass('type-b-disabled');
    }
  });
});
