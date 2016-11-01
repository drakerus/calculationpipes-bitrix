var demo_bgs,
  demo_colors,
  demo_types,
  demo_steps = 10,
  demo_delay = 1000,
  current_play = 0;

function random(max) {
  return Math.floor(Math.random() * max + 1)
}

function go_litr(num) {
  if (num == 10) {
    $("input:radio").each(function () {
      var name = $(this).attr("name");
      var rValue = $(this).attr("value");
      $(this).removeClass('disRadio');
      $(this).removeProp('disabled');
      if ((name == 'browser') && (rValue != 4) && (rValue != 5)) {
        $(this).attr('disabled', 'true');
        $(this).addClass('disRadio');
      }
    });
  } else if (num == '!100') {
    $("input:radio").each(function () {
      var name = $(this).attr("name");
      var rValue = $(this).attr("value");
      $(this).removeClass('disRadio');
      $(this).removeProp('disabled');
      if ((name == 'browser') && (rValue == 4 || rValue == 5)) {
        $(this).attr('disabled', 'true');
        $(this).addClass('disRadio');
      }
    });
  } else {
    $("input:radio").each(function () {
      var name = $(this).attr("name");
      if (name == 'browser') {
        $(this).removeAttr('disabled');
        $(this).removeClass('disRadio');
      }
    });
  }

  if (num == 10) {
    $('#max_print').html(30);
    $('#min_print').html(0);
  } else if (num == 30) {
    $('#max_print').html(30);
    $('#min_print').html(30);
  } else if (num == 30 || num == 50 || num == 80 || num == 100) {
    $('#max_print').html(num);
    $('#min_print').html(num);
  } else if (num == '!100') {
    $('#max_print').html('&infin;');
    $('#min_print').html('100');
  }

  lb = $('input[name=litr]:checked + label').text();
  $('#step1').children('h3').children('.smallSpan').remove();
  $('#step1').children('h3').append('<span class="smallSpan">Вы выбрали ' + lb + '</span>').show('slow');

  if($("form[name=formsearch]").data('action') != 'search'){
    $("input[name=browser]").removeProp('checked');
    $("input[name=browser]:not(:disabled):first").prop('checked', true);
  }
}

function change_type(num,img_src='') {
  num = num.toString(10);
  var $img = $('#ddd1'),
    $this_checkbox = $('input[name=browser]:checked'),
    $vodonag_img_wrap = $('#se_img1'),
    $vodonag_img = $vodonag_img_wrap.find('img'),
    custom_val = $('#CustomFlag').val();

  if (custom_val == 'no') {
    var img_class = 'bg_' + $img.data('bg') + ' back_' + num;
  } else {
    img_class = 'back_' + num;
  }

  $img.attr('class', img_class);
  var vodonag_img_path = img_src;//'vodonag/pos/' + num + $vodonag_img.data('color') + '.png';
  $vodonag_img.attr('src', vodonag_img_path);

  $('#s_name').text($this_checkbox.data('name'));
  $('#sposob').val($this_checkbox.data('sposob'));
  var lb = $this_checkbox.next('label').text();
  $('#step2').children('h3').children('.smallSpan').remove();
  $('#step2').children('h3').append('<span class="smallSpan">Вы выбрали ' + lb + '</span>').show('slow');

}

function set_img(num) {
  var br_value;
  for (var i = 0; i < document.formsearch.browser.length; i++) {
    if (document.formsearch.browser[i].checked) {
      br_value = document.formsearch.browser[i].value;
    }
  }
var m='img_'+br_value+'__'+num;

  if (num == '0') 
  {
    $('#se_img1').html('<img data-color="_mirror_blue" src="'+$('#'+m).val()+'">');
    $('#color').val('0');
    $('#color_name').html('Другой цвет');
    return;
  }

  var inner,
    color_body,
    color_border,
    num_one,
    id_img, id_color, id_sposob;

  id_img = 'se_img1';//+num_one;

  get_radio_value();
  var br_value;
  for (var i = 0; i < document.formsearch.browser.length; i++) {
    if (document.formsearch.browser[i].checked) {
      br_value = document.formsearch.browser[i].value;
    }
  }

  var arr = ['_white_white', '_gray_white', '_black_white', '_lblue_white', '_black_mirror', '_silver', '_blue_white', '_black_mat'];

  inner = '<img data-color="' + arr[num - 1] + '" src="'+$('#'+m).val()+'">';

  var colors = ['white/white', 'gray/white', 'black/white', 'lblue/white', 'black/mirror', 'silver', 'blue/white', 'black/mat'];
  color = colors[num - 1];

  num_one = br_value;
  id_color = 'color';//+num_one;
  id_sposob = 'sposob';//+num_one;

  if (num_one == "1")
    sposob = "ver";
  else if (num_one == "2")
    sposob = "gor";
  else if (num_one == "3")
    sposob = "napol";
  else if (num_one == "4")
    sposob = "pod";
  else if (num_one == "5")
    sposob = "nad";

  document.getElementById(id_img).innerHTML = inner;
  document.getElementById(id_color).value = color;
  //document.getElementById(id_sposob).value = sposob;
	var info=new Array();
	var kol=0;
	$('.colors a.colorChoose').each(function()
	{
		info[kol++]=$(this).data('color_name');
	});

//alert(info);
//  info = ["", "Белый-белый", "Серый-белый", "Черный-белый", "Голубой-белый", "Черный-зеркальный", "Зеркальный", "Синий-белый", "Черный-матовый"];

  $('#color_name').html(info[num-1]);
  $('#colnum').val(num);
}

function set_bg(bg) {
  var bg_one, id_element;

  if(bg == 'custom'){
    var $custom_bg = $("#custom_bg");
    var back_url = "url('"+ $("#custom_bg").data('path') +"?"+ new Date().valueOf() +"')";
    $('#ddd1').data('path', $("#custom_bg").data('path')).css('background-image', back_url);
    $("#CustomFlag").val('yes');
  }else{
    $("#CustomFlag").val('no');
    bg_one = bg.toString();
    id_element = 'ddd1';//+bg_one;
    var br_value;
    for (var i = 0; i < document.formsearch.browser.length; i++) {
      if (document.formsearch.browser[i].checked) {
        br_value = document.formsearch.browser[i].value;
      }
    }

    document.getElementById(id_element).className = 'bg_' + bg_one;
    $('#ddd1').addClass('back_' + br_value).data({path: '', bg: bg_one});

    //document.getElementById(id_element).className='bg' + "_" + bg_one;
    document.getElementById('bg').value = bg_one;
    $('#CustomFlag').val('no');
    document.getElementById('ddd1').style.removeProperty('background-image');
  }
}

function generate_demo_data() {
  demo_bgs = [];
  demo_colors = [];
  demo_types = [];
  var count_types = $('input[name=browser]').length,
    count_bgs = $('.backgrounds a').length,
    count_colors = $('.colors a').length;
  for (var i = 0; i < demo_steps; i++) {
    demo_types.push(random(count_types));
  }
  for (i = 0; i < demo_steps; i++) {
    demo_bgs.push(random(count_bgs));
  }
  for (i = 0; i < demo_steps; i++) {
    demo_colors.push(random(count_colors));
  }
}

var interval_id;
function play_demo() {
  interval_id = setInterval(function () {
    $('input[name=browser]:eq(' + demo_types[current_play] + ')').prop('checked', true);
    change_type(demo_types[current_play]);

    set_img(demo_colors[current_play]);
    set_bg(demo_bgs[current_play]);
    if (current_play < (demo_steps - 1)) {
      current_play++;
    } else {
      current_play = 0;
      generate_demo_data();
    }
    console.log('play: ' + current_play);
  }, demo_delay);
}

function pause_demo() {
  if (interval_id !== undefined) {
    clearInterval(interval_id);
  }
  console.log('pause: ' + current_play);
}

function back_demo() {
  if (current_play == 0) {
    return current_play;
  } else {
    current_play--;
    $('input[name=browser]:eq(' + demo_types[current_play] + ')').prop('checked', true);
    change_type(demo_types[current_play]);

    set_img(demo_colors[current_play]);
    set_bg(demo_bgs[current_play]);
    console.log('back: ' + current_play);
    return current_play;
  }
}

function forward_demo() {
  if (current_play == (demo_steps - 1)) {
    return current_play;
  } else {
    current_play++;
    $('input[name=browser]:eq(' + demo_types[current_play] + ')').prop('checked', true);
    change_type(demo_types[current_play]);

    set_img(demo_colors[current_play]);
    set_bg(demo_bgs[current_play]);
    console.log('forward: ' + current_play);
    return current_play;
  }
}


function getFileName(path) {
  var fileNameIndex = path.lastIndexOf("/") + 1;
  var filename = path.substr(fileNameIndex);
  return filename;
}


$(function () {
  generate_demo_data();

  $('#demo_play').click(function () {
    play_demo();
    $("#demo_pause").show();
    $(this).hide();

    $('#demo_forward, #demo_back').removeClass('disabled').removeAttr('disabled');
  });

  $("#demo_pause").click(function () {
    pause_demo();
    $('#demo_play').show();
    $(this).hide();
  });

  $('#demo_back').click(function () {
    var n_slide = back_demo();
    if (n_slide == 0) {
      $(this).addClass('disabled').attr('disabled', 'disabled');
    } else {
      $('#demo_forward').removeClass('disabled').removeAttr('disabled');
    }
  });

  $('#demo_forward').click(function () {
    var n_slide = forward_demo();
    if (n_slide == (demo_steps - 1)) {
      $(this).addClass('disabled').attr('disabled', 'disabled');
    } else {
      $('#demo_back').removeClass('disabled').removeAttr('disabled');
    }
  });

  /*$('#file_uploader').dmUploader({
    url: '/save_img.php',
    dataType: 'json',
    allowedTypes: 'image/*',
    fileName: 'userImg',
    maxFiles: 1,
    extraData: {
      flagVar: 'load',
      MAX_FILE_SIZE: '30000'
    },
    onUploadSuccess: function (id, data) {
      if ($('#uploaded_image').length > 0) {
        var $image = $('#uploaded_image');
      } else {
        $image = $('<img id="uploaded_image">');
      }
      $('#wrap_image').empty().append($image);
      $image.attr({
        src: data.img_path,
        style: 'width: 100%; height: auto;'
      });
      var aspect_ratio = 0.88,
        scaled_width = $image.width(),
        scaled_height = (scaled_width / data.img_width) * data.img_height,
        default_select = [0, 0, aspect_ratio * scaled_width, aspect_ratio * scaled_height];

      $('#image_name').val(data.img_name);
      $('#image_width').val(scaled_width);

      $image.Jcrop({
        aspectRatio: aspect_ratio,
        setSelect: default_select,
        onSelect: function (c) {
          // c.x, c.y, c.x2, c.y2, c.w, c.h
          var size = c.x + ',' + c.y + ',' + c.w + ',' + c.h;
          $('#image_xywh').val(size);
        }
      });

      $.fancybox.update();
    }
  });*/

  $('#form_upload_img').submit(function(e){
    e.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: $(this).attr('method'),
      dataType: 'json',
      data: $(this).serialize(),
      success: function(data){
        if(data.image_name){
          var back_url = "url('/vodonag/user_files/"+ data.image_name +"?"+ new Date().valueOf() +"')";
          $('#ddd1').data('path', '/vodonag/user_files/'+data.image_name).css({
            'background-image': back_url,
            'background-size': 'cover'
          });
          if($('.backgrounds .custom_bg').length == 0){
            var $custom_bg_link = $('<a class="grad_vod custom_bg"></a>');
            $custom_bg_link.attr('href', "javascript:set_bg('custom')");
            $custom_bg_link.css({
              'background-image': back_url,
              'background-size': 'cover'
            });
            $('.backgrounds').append($custom_bg_link);
          }else{
            $custom_bg_link = $('.backgrounds .custom_bg');
            $custom_bg_link.css({
              'background-image': back_url,
              'background-size': 'cover'
            });
          }
          
          $("#CustomFlag").val('yes');

          $.fancybox.close();
        }
      }
    });
  });


  $('.fancybox').fancybox({
    padding: 0,
    autoSize: true,
    closeBtn: false
  });
  $("#close_fancybox_image").click(function(){
    $.fancybox.close();
  });

  $('#save_img').click(function () {
    var vod_file = $('#se_img1').children('img').attr('src');
    vod_file = getFileName(vod_file);

    if ($('#ddd1').data('path')) {
      var back_file = $('#ddd1').data('path');
    } else {
      back_file = $('#ddd1').css('background-image');
      back_file = back_file.replace('url(', '').replace(')', '');
      back_file = '/vodonag/back/' + getFileName(back_file);
    }

    var pol_file = '';
    if (($('#sposob').val() == 'napol') || ($('#sposob').val() == 'pod')) {
      pol_file = 'pol.png';
    }

    var custom = $('#CustomFlag').val();

    $('<form action="/save_img.php" method="POST"><input type="hidden" name="vod_img" value="' + vod_file + '"><input type="hidden" name="back_img" value="' + back_file + '"><input type="hidden" name="pol_img" value="' + pol_file + '"><input type="hidden" name="sposob" value="' + $('#sposob').val() + '"><input type="hidden" name="flagVar" value="save"><input type="hidden" name="flagVarC" value="' + custom + '"></form>').appendTo('body').submit();

    return false;
  });

  $('.colorChoose').click(function () {
    lb = $(this).attr('title');
    $('#step3').children('h3').children('.smallSpan').remove();
    $('#step3').children('h3').append('<span class="smallSpan">Вы выбрали ' + lb + '</span>').show('slow');
  });


  $('#id1').click(function(e){
    e.preventDefault();
    if ($('#id2').css('display') == 'block') {
      $('#id2').hide();
      $('#id2').css('display', 'none');
      $('.vodonag_text').hide();
      $('.vodonag_text').css('display', 'none');
      $(this).html('Форма поиска скрыта. Показать форму поиска?');
      $('.shade_form').css('margin-top', '30px');
      $('#res_small').hide();
      $('#res_big').show();
    } else {
      $('#id2').show();
      $('#id2').css('display', 'block');
      $('.vodonag_text').show();
      $('.vodonag_text').css('display', 'block');
      $(this).html('Скрыть форму поиска');
      $('#res_small').show();
      $('#res_big').hide();

      if ($('#step3').attr('class') == 'step-active') {
        $('.shade_form').css('margin-top', '-80px');
      }
    }
  });
});