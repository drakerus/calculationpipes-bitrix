Number.prototype.formatMoney = function(c, d, t){
  var n = this, 
      c = isNaN(c = Math.abs(c)) ? 2 : c, 
      d = d == undefined ? "." : d, 
      t = t == undefined ? "," : t, 
      s = n < 0 ? "-" : "", 
      i = parseInt(n = Math.abs(+n || 0).toFixed(c)) + "", 
      j = (j = i.length) > 3 ? j % 3 : 0;
  return s + (j ? i.substr(0, j) + t : "") + i.substr(j).replace(/(\d{3})(?=\d)/g, "$1" + t) + (c ? d + Math.abs(n - i).toFixed(c).slice(2) : "");
};

if(typeof(String.prototype.trim) === "undefined"){
    String.prototype.trim = function(){
      return String(this).replace(/^\s+|\s+$/g, '');
    };
}

function update_basket(data){
  var count = 0,
    total_price = 0;
  for(var o in data){
    product_count = parseInt(data[o].num);
    product_price = parseInt(data[o].price);
    count += product_count;
    total_price += product_price * product_count;
  }
  $("#basket_count").text(count);
  $("#basket_total_price").text(total_price);
}

var cart_slider;
function show_to_basket_dialog(good_id){
  $('#cart_slider').html('');

  $.ajax({
    url: '/basket',
    data: { action: 'get_goods', good_id: good_id },
    type: 'POST',
    dataType: 'json',
    success: function(response){
      var data = response.data;
      if(data.length > 0){
        var html =
          '<col width="20%">' +
          '<col width="60%">' +
          '<col width="20%">';
        for(var i = 0; i < data.length; i++){
          var good = data[i];
          html += '<tr>'+
            '<td><img src="'+ good.image +'" class="one-click-image"></td>'+
            '<td class="td-one-click-good-title">'+
              '<input type="hidden" name="goods['+ i +'][id]" value="'+ good.id +'" />'+
              '<a href="'+ good.link +'">'+ good.name +'</a>'+
              '<div class="wrap-good-count">'+
                '<span class="btn-good-count-one-click minus" data-type="dec" title="Уменьшить количество"></span><input type="text" class="good-count" name="goods['+ i +'][count]" style="width: 30px;" value="'+ good.basket_num +'"><span class="btn-good-count-one-click plus" data-type="inc" title="Увеличить количество"></span>'+
              '</div>'+
            '</td>'+
            '<td><span class="one-click-price" data-base-price="'+ good.price +'">'+ good.basket_price +'</span> руб.</td>'+
          '</tr>';
        }
        $('#tbl_cart_goods').html(html);

        $(".btn-good-count-one-click").click(function(){
          var $parent = $(this).closest(".wrap-good-count"),
              $row = $(this).closest('tr'),
              $input = $parent.find("input.good-count"),
              value = parseInt($input.val()),
              btn_type = $(this).data('type'),
              good_price = parseInt($row.find(".one-click-price").data('base-price'));
          if(value == undefined){
            value = 1;
          }else{
            if(value >= 1){
              if(btn_type == 'inc'){
                value += 1;
              }else if(btn_type == 'dec'){
                value -= 1;
                if(value == 0){ value = 1; }
              }
            }
          }
          $input.val(value);
          var price_result = good_price * value;
          $row.find(".one-click-price").text(price_result.formatMoney(0, '.', ' '));

          // Update basket
          var $form = $("#form_cart_goods"),
              data = 'action=recalc&',
              inputs = $form.find('input[name*=goods]');
          inputs.each(function(){
            data += $(this).attr('name') + '=' + $(this).val() + '&';
          });
          $.ajax({
            url: "/basket",
            data: data,
            type: "POST",
            dataType: "json",
            success: function(response){
              update_basket(response.data);
            }
          });
        });
      }
    }
  });

  $.ajax({
    url: '/basket',
    data: { action: 'get_lookslike_goods', good_id: good_id },
    type: 'POST',
    dataType: 'json',
    success: function(data){
      if(data.length > 0){
        $('#interest_title').show();
        var html = '';
        for(var i = 0; i < data.length; i++){
          var good = data[i];
          html += '<li class="interest-good">'+
            '<a href="'+ good.link +'" class="interest-good-img"><img src="'+ good.image +'"></a>'+
            '<a href="'+ good.link +'" class="interest-good-title">'+ good.name +'</a>'+
            '<div class="interest-good-price">'+ good.price +' руб.</div>'+
          '</li>';
        }
        $('#cart_slider').html(html);

        if($("#cart_slider").parent('.bx-viewport').length == 0){
          cart_slider = $("#cart_slider").bxSlider({
            responsive: true,
            minSlides: 3,
            maxSlides: 3,
            // slideWidth: 220,
            slideMargin: 20,
            adaptiveHeight: true,
            controls: true,
            pager: false
          });
        }else{
          cart_slider.reloadSlider();
        }
      }else{
        $('#interest_title').hide();
      }
    }
  });
  
  $.fancybox.open($("#add_to_basket_dialog"), {
    fitToView: false,
    maxWidth: 600,
    autoSize: true,
    closeClick: false,
    openEffect: 'none',
    closeEffect: 'none',
    padding: [20, 0, 20, 0],
    tpl: {
      closeBtn: '<a title="Close" class="fancybox-item fancybox-close ts-fancybox-close" href="javascript:;"></a>'
    }
  });
}

function show_one_click_dialog(){
  $.fancybox.open($("#buy_one_click"), {
    fitToView: false,
    width: 580,
    autoSize: true,
    closeClick: false,
    openEffect: 'none',
    closeEffect: 'none',
    padding: [20, 0, 20, 0],
    tpl: {
      closeBtn: '<a title="Close" class="fancybox-item fancybox-close ts-fancybox-close" href="javascript:;"></a>'
    }
  });
}

function ByGood(id, maker, good, good_id, price, mod, s, object) {
  var req_data = {
    good_id: good_id,
    good_price: price,
    add: 1
  };
  if(object){
    var $object = $(object);
  }
  $.ajax({
    url: '/catalog',
    data: req_data,
    type: 'POST',
    dataType: 'json',
    success: function(response){
      update_basket(response.data);
      if(object){
        if($object.data('show-dialog') == undefined || $object.data('show-dialog') == true){
          show_to_basket_dialog(good_id);
          $("#close_to_basket_dialog").data("reload", $object.data("reload"));
        }else{
          if($object.data("reload")){
            window.location.reload();
          }
        }
      }else{
        show_to_basket_dialog(good_id);
      }

    }
  });
}

function init_buy_one_click_dialog(){
  $(".btn-good-count-one-click").click(function(){
    var $parent = $(this).closest(".wrap-good-count"),
        $row = $(this).closest('tr'),
        $input = $parent.find("input.good-count"),
        value = parseInt($input.val()),
        btn_type = $(this).data('type'),
        good_price = parseInt($row.find(".one-click-price").data('base-price'));
    if(!value){
      value = 1;
    }else{
      if(value >= 1){
        if(btn_type == 'inc'){
          value += 1;
        }else if(btn_type == 'dec'){
          value -= 1;
          if(value == 0){
            value = 0;
            $(this).closest('.tr-good-one-click').hide();
          }
        }
      }
    }
    $input.val(value);
    var price_result = good_price * value;
    $row.find(".one-click-price").text(price_result.formatMoney(0, '.', ' '));

    // Update basket
    var $form = $("#form_one_click"),
        data = 'action=recalc&',
        inputs = $form.find('input[name*=goods]');
    inputs.each(function(){
      data += $(this).attr('name') + '=' + $(this).val() + '&';
    });
    $.ajax({
      url: "/basket",
      data: data,
      type: "POST",
      dataType: "json",
      success: function(response){
        update_basket(response.data);
      }
    });
  });

  $('#order_phone').mask('+7(999)999-99-99');
}

function buy_one_click(id, maker, good, good_id, price, mod, s) {
  var req_data = {
    good_id: good_id,
    good_price: price,
    add: 1
  };
  $.ajax({
    url: '/catalog',
    data: req_data,
    type: 'POST',
    dataType: 'json',
    success: function(response){
      update_basket(response.data);
    }
  });

  $.ajax({
    url: '/basket',
    data: { action: 'get_goods' },
    type: 'POST',
    dataType: 'json',
    success: function(response){
      var data = response.data;
      if(data.length > 0){
        var html =
          '<col width="20%">' +
          '<col width="60%">' +
          '<col width="20%">';
        for(var i = 0; i < data.length; i++){
          var good = data[i];
          html += '<tr class="tr-good-one-click">'+
            '<td><img src="'+ good.image +'" class="one-click-image"></td>'+
            '<td class="td-one-click-good-title">'+
              '<input type="hidden" name="goods['+ i +'][id]" value="'+ good.id +'" />'+
              '<a href="'+ good.link +'">'+ good.name +'</a>'+
              '<div class="wrap-good-count">'+
                '<span class="btn-good-count-one-click minus" data-type="dec" title="Уменьшить количество"></span><input type="text" class="good-count" name="goods['+ i +'][count]" style="width: 30px;" value="'+ good.basket_num +'"><span class="btn-good-count-one-click plus" data-type="inc" title="Увеличить количество"></span>'+
              '</div>'+
            '</td>'+
            '<td><span class="one-click-price" data-base-price="'+ good.price +'">'+ good.basket_price +'</span> руб.</td>'+
          '</tr>';
        }
        $('#tbl_one_click_goods').html(html);
        init_buy_one_click_dialog();
      }

      show_one_click_dialog();
    }
  });
}

function next_step(obj){
  $('.step, .cart-step').removeClass('active');
  var $step = $(obj.attr('href'));
  $step.addClass('active');
  if ($step.attr('id') == 'step3') {
    $('#action_submit').addClass('for-step3');
  } else {
    $('#action_submit').removeClass('for-step3');
  }
  if(obj.data('anchor')){
    window.location.hash = obj.data('anchor');  
  }
}

$(function(){
  // Прячем от ботов тег form переименовав его в ts_form
  // Скриптом его переименовываем назад
  $('ts_form').each(function(){
    var attr = $(this).prop("attributes");
    var form = $('<form>');
    $.each(attr, function(){
      form.attr(this.name, this.value);
    });
    form.html($(this).html());
    $(this).replaceWith(form);
  });

  $("#close_to_basket_dialog").click(function(e){
    e.preventDefault();
    $.fancybox.close();
    if($(this).data('reload') && $(this).data('reload') == true){
      window.location.reload();
    }
  });
  var params = {
    changedEl: "#select_payment, #select_shipping, #select_status, #admin_actions",
    visRows: 5,
    scrollArrows: true
  };
  cuSel(params);

  $('#form_one_click').validate({
    errorElement: "em",
    rules: {
      phone: "required",
      name: "required",
      captcha: "required"
    }
  });

  $('.masked-mobphone').mask('+7(999)999-99-99');
  $('.type-phone').click(function(e){
    e.preventDefault();
    var parent = $(this).parent();
    if($(this).hasClass('active')){
      if(parent.hasClass('showed')){
        parent.removeClass('showed');
      }else{
        parent.addClass('showed');
      }
    }else{
      parent.find('.type-phone').removeClass('active');
      $(this).addClass('active');
      parent.removeClass('showed');
    }

    if(parent.data('for') != undefined){
      var phone_mask = $(parent.data('for'));
    }else{
      phone_mask = $('#order_phone');
    }

    if($(this).attr('href') == '#static_phone'){
      phone_mask.unmask();
    }else{
      phone_mask.mask('+7(999)999-99-99');
    }
  });

  if(typeof(dataTable) == "function"){
    $('#clients_table').dataTable({
      language: {
        search: "Поиск клиента:",
        paginate: {
          next: "Далее",
          previous: "Назад"
        }
      },
      "columnDefs": [{
        "searchable": false,
        "orderable": false,
        "targets": 0
      },
        {
          "searchable": false,
          "orderable": false,
          "targets": 15
        },
        {
          "searchable": false,
          "orderable": false,
          "targets": 12
        },
        {
          "searchable": false,
          "orderable": false,
          "targets": 11
        }],
      "order": [[1, 'asc']]
    });
  }

  $(".sidebar").height( $(".content").outerHeight(true) );

  if($("#bx_product_slider").length > 0)
    $("#bx_product_slider").bxSlider({
      responsive:true,
      minSlides: 3,
      maxSlides: 10,
      slideWidth: 250,
      slideMargin: 15,
      nextSelector: "#product_next",
      prevSelector: "#product_prev",
      controls: true,
      pager: false
    });

  $('.continue').click(function(e){
    e.preventDefault();
    next_step($(this));
  });

  $('.step h3').click(function(){
    var $step = $(this).parent();
    if($step.hasClass('disabled')){
      return false;
    }

    if (!$step.hasClass('active')) {
      $('.step, .cart-step').removeClass('active');
      $step.addClass('active');
    }
    if ($step.attr('id') == 'step3') {
      $('#action_submit').addClass('for-step3');
    } else {
      $('#action_submit').removeClass('for-step3');
    }

    if($step.data('anchor')){
      window.location.hash = $step.data('anchor');  
    }
  });

});


// Limit scope pollution from any deprecated API
(function() {

  var matched, browser;

// Use of jQuery.browser is frowned upon.
// More details: http://api.jquery.com/jQuery.browser
// jQuery.uaMatch maintained for back-compat
  jQuery.uaMatch = function( ua ) {
    ua = ua.toLowerCase();

    var match = /(chrome)[ \/]([\w.]+)/.exec( ua ) ||
      /(webkit)[ \/]([\w.]+)/.exec( ua ) ||
      /(opera)(?:.*version|)[ \/]([\w.]+)/.exec( ua ) ||
      /(msie) ([\w.]+)/.exec( ua ) ||
      ua.indexOf("compatible") < 0 && /(mozilla)(?:.*? rv:([\w.]+)|)/.exec( ua ) ||
      [];

    return {
      browser: match[ 1 ] || "",
      version: match[ 2 ] || "0"
    };
  };

  matched = jQuery.uaMatch( navigator.userAgent );
  browser = {};

  if ( matched.browser ) {
    browser[ matched.browser ] = true;
    browser.version = matched.version;
  }

// Chrome is Webkit, but Webkit is also Safari.
  if ( browser.chrome ) {
    browser.webkit = true;
  } else if ( browser.webkit ) {
    browser.safari = true;
  }

  jQuery.browser = browser;

  jQuery.sub = function() {
    function jQuerySub( selector, context ) {
      return new jQuerySub.fn.init( selector, context );
    }
    jQuery.extend( true, jQuerySub, this );
    jQuerySub.superclass = this;
    jQuerySub.fn = jQuerySub.prototype = this();
    jQuerySub.fn.constructor = jQuerySub;
    jQuerySub.sub = this.sub;
    jQuerySub.fn.init = function init( selector, context ) {
      if ( context && context instanceof jQuery && !(context instanceof jQuerySub) ) {
        context = jQuerySub( context );
      }

      return jQuery.fn.init.call( this, selector, context, rootjQuerySub );
    };
    jQuerySub.fn.init.prototype = jQuerySub.fn;
    var rootjQuerySub = jQuerySub(document);
    return jQuerySub;
  };

})();