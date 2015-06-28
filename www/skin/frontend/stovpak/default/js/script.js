$(document).ready(function(){

  // js inputs -----------------
  $('input').iCheck({
    cursor: true
  });

  $('select').each(function() {
    var select = $(this);
    select.selecter({
      customClass: select.attr('class')
    });
  });

  // Header --------------------
  var navExpanded = false;
  var closeNav = function() {
    setTimeout(function() {
      if (!navExpanded) {
        $('.subnav').hide();
      }
    },100);
  };

  $('.header-nav > ul > li > a').on('mouseenter',function(e) {
    var li_s = $(this).parents('ul').eq(0).find('li'),
        index = li_s.index($(this).parent('li'));

    $('.subnav').hide().eq(index).show();
    navExpanded = true;
  }).on('mouseleave',function() {
    navExpanded = false;
    closeNav();
  });

  $('.subnav').on('mouseenter',function() {
    navExpanded = true;
  }).on('mouseleave',function() {
    navExpanded = false;
    closeNav();
  });

  $('.mobile-nav-toggle').on('click',function(e) {
    e.preventDefault();
    $('.mobile-nav').toggle();
  });

  $('.mobile-nav').on('click','.with-subnav > a',function(e) {
    e.preventDefault();
    $(this).parent().toggleClass('opened');
  });

  // Top Color Slider ----------
  $('.color-pallets').slick({
    arrows: true,
    draggable: false,
    touchMove: false,
    slidesToShow: 82,
    slidesToScroll: 82,
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

  // catalog-types -------------
  $('.catalog-types').on('click','a',function() {
    $(this).siblings()
              .removeClass('active').end()
           .addClass('active');
  });

  // Popups --------------------
  $('.popup-close, .popup-layout').on('click',function(e) {
    e.preventDefault();

    $('.popup, .popup-layout').hide();
  });

}).on('click',function(e) {
  var target = $(e.target);
  if (target.parents('.selecter-fake').length <= 0) {
    $('.selecter').removeClass('open');
  }
});

function OpenPopup(popupName) {
  $('.'+popupName+', .popup-layout').show();
}
