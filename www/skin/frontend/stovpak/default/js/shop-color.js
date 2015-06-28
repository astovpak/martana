$(document).ready(function() {
  $('.range-input').each(function() {
    var self = $(this),
        textInput = self.parents('figcaption').eq(0).find('.form-text'),
        value;

    value = /\d*/.exec(textInput.val())[0];
    self.slider({
      orientation: "horizontal",
      range: "min",
      min: 0,
      max: 100,
      value: value,
      slide: function(e,obj) {
        textInput.val(obj.value+'%');
      }
    });
  });

  $('.remove-active-color').on('click',function(e) {
    e.preventDefault();
    var colorItem = $(this).parents('.shop-color-palette-item').eq(0);

    $(this).parent().removeAttr('style');
    colorItem.addClass('empty');
  });

  $('.shop-color-item').each(function() {
    var self = $(this);

    self.tooltipster({
      contentAsHTML: true,
      // touchDevices: false,
      theme: "color-tooltip",
      trigger: "hover",
      content: "<figure><div class='bg-color' style='"+self.attr('style')+"'></div><figcaption>"+self.data('title')+"</figcaption></figure>"
    });
  });

  var cropBox = $('.shop-color-upload-preview');
  var cropImage = $('#crop-image');
  var previewImage = $('#preview-image');
  var paletteColorsBox = $('.shop-color-upload-palette');
  var inputFile = document.getElementById('input-file');
  inputFile.addEventListener('click', function() {this.value = null;}, false);
  inputFile.addEventListener('change', readData, false);

  var jcrop_api;
  function readData(evt) {
    evt.stopPropagation();
    evt.preventDefault();
    var file = evt.dataTransfer !== undefined ? evt.dataTransfer.files[0] : evt.target.files[0];
    var reader = new FileReader();
    var cw = 440, ch = 440;

    if ($(window).width() < 640) {
      cw = ch = 300;
    }
    if (jcrop_api) {
      jcrop_api.destroy();
    }

    cropImage.show();
    reader.onload = (function(theFile) {
      return function(e) {
        var image = new Image();
        image.src = e.target.result;
        image.onload = function() {
          var canvas = document.createElement('canvas');
          // canvas.height = ch;
          if (image.height > image.width) {
            canvas.width = image.width * (cw / image.height);
            canvas.height = ch;
            cropBox.removeAttr('style')
                   .css({
                    width: canvas.width,
                    margin: '0 '+((cw - canvas.width)/2 + 50)+'px 0 '+((cw - canvas.width)/2)+'px'
                   });
          } else {
            canvas.height = image.height * (ch / image.width);
            canvas.width = cw;
            cropBox.removeAttr('style')
                   .css('height','auto');
          }
          var ctx = canvas.getContext('2d');
          ctx.drawImage(image, 0, 0, canvas.width, canvas.height);

          cropImage.attr('src',canvas.toDataURL());

          var img = cropImage[0];
          canvas = document.createElement('canvas');

          cropImage.Jcrop({
            // bgColor: 'black',
            keySupport: false,
            bgOpacity: 1,
            aspectRatio: 1,
            // minSize: [1, 1],
            onSelect: function(selection) {
              imgSelect(selection);
              parsePalette();
            },
            onChange: imgSelect
          },function(){
            jcrop_api = this;
          });

          // parsePalette(true);
          paletteColorsBox.removeClass('visibled');
          previewImage.attr('src', 'images/blank.gif');

          function imgSelect(selection) {
            canvas.width = canvas.height = 100;

            var ctx = canvas.getContext('2d');
            if (selection.w < 10) selection.w = 10;
            if (selection.h < 10) selection.h = 10;
            ctx.drawImage(img, selection.x, selection.y, selection.w, selection.h, 0, 0, canvas.width, canvas.height);

            previewImage.attr('src', canvas.toDataURL());
          }
        };
      };
    })(file);
    reader.readAsDataURL(file);
  }

  function parsePalette(original) {
    var colorThief = new ColorThief(),
        paletteList = $('.shop-color-list',paletteColorsBox),
        palette;

    if (original) {
      palette = colorThief.getPalette(cropImage[0], 26);
    } else {
      palette = colorThief.getPalette(previewImage[0], 26);
    }

    // if (!original) {
    //   $('.jcrop-holder').hide();
    //   previewImage.show();
    // }
    paletteColorsBox.addClass('visibled');
    paletteList.empty();

    for (var i=0;i<palette.length;i++) {
      var newPaletteColor = '<div class="shop-color-item"'+
                            'style="background-color: rgb('+
                              palette[i][0]+','+
                              palette[i][1]+','+
                              palette[i][2]+
                            ')"><a href="#"></a></div>';
      paletteList.append(newPaletteColor);
    }
  }

  // $('.shop-color-change-palette').on('click','a',function(e) {
  //   e.preventDefault();

  //   previewImage.hide();
  //   $('.jcrop-holder').show();
  // });

  $('.shop-color-tabs-item').on('click',function(e) {
    e.preventDefault();
    var pane = $($(this).attr('href'));

    $('.shop-color-pane, .shop-color-bottom').hide();
    pane.slideDown('fast');
    $('body, html').animate({
      scrollTop: pane.offset().top
    },800,function() {
      $('.shop-color-bottom').slideDown('fast');
    });
  });
});
