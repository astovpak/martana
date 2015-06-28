$(document).ready(function() {
  $('.b-checks').jScrollPane({
    autoReinitialise: true,
    verticalDragMaxHeight: 40
  });

  $('.color-range .range-input').slider({
    orientation: "horizontal",
    range: "min",
    max: 100,
    value: 50,
    slide: function(e,obj) {
      $(this).parents('.color-palette-item').eq(0)
              .find('.color-percent')
                .text(obj.value+'%');
    }
  });

  $('.double-range .range-input').slider({
    orientation: "horizontal",
    range: true,
    min: 0,
    max: parseInt($('#max-price').val())+5,
    values: [$('#min-price').val(), $('#max-price').val()],
    slide: function(e,obj) {
      $(this).parent()
              .find('.range-label-left span')
                .text(obj.values[0])
                .end()
              .find('.range-label-right span')
                .text(obj.values[1])
                .end()
              /*.find('#min-price')
                .val(obj.values[0])
                .end()
              .find('#max-price')
                .val(obj.values[1])*/
                .end() ;
                
    },
    stop: function(e,obj){
        var currenturl=$(this).parent().find('#base-url').val();
         $(this).parent().find('#filter-link').attr("href", currenturl+'?price='+$(this).parent().find('.range-label-left span').text()+'-'+$(this).parent().find('.range-label-right span').text())
                 
                .end();
                
    }
  });
  $('.price-range .range-input').slider({
    min: 1,
    max: 500,
    values: [ 1, 300 ]
  });

  $('.filter-toggle').on('click',function() {
    $(this).parents('.filter-item').eq(0)
            .toggleClass('opened');
  });

  $('.selecter-fake').on('click','.selecter-selected',function() {
    var self = $(this);
    self.parent().toggleClass('open');
  });
});
