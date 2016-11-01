$(function () {
    $('.under30').click(function () {
        $('#step2').children('h3').children('.smallSpan').remove();
        $('#step2').children('h3').append('<span class="smallSpan">Вы выбрали над раковиной</span>').show('slow');
        $(".rakovina_nad").attr("checked", true);
        chande_type(5);
    });

    $('.over100').click(function () {
        $('#step2').children('h3').children('.smallSpan').remove();
        $('#step2').children('h3').append('<span class="smallSpan">Вы выбрали напольный</span>').show('slow');
        $(".napoln").attr("checked", true);
        chande_type(3);
    });
});


var intervalID;

function show(visible) {
    //var ind=visible-1;
    //document.formsearch.browser[ind].checked=true;
//alert(ind+document.formsearch.browser[ind].checked);
    alert(visible);
    if (visible == "1") {
        document.getElementById('show5').className = 'none';
        document.getElementById('show4').className = 'none';
        document.getElementById('show3').className = 'none';
        document.getElementById('show2').className = 'none';
        document.getElementById('show1').className = 'block';
    }
    if (visible == "2") {
        document.getElementById('show5').className = 'none';
        document.getElementById('show4').className = 'none';
        document.getElementById('show3').className = 'none';
        document.getElementById('show2').className = 'block';
        document.getElementById('show1').className = 'none';
    }
    if (visible == "3") {
        document.getElementById('show5').className = 'none';
        document.getElementById('show4').className = 'none';
        document.getElementById('show3').className = 'block';
        document.getElementById('show2').className = 'none';
        document.getElementById('show1').className = 'none';
    }
    if (visible == "4") {
        document.getElementById('show5').className = 'none';
        document.getElementById('show4').className = 'block';
        document.getElementById('show3').className = 'none';
        document.getElementById('show2').className = 'none';
        document.getElementById('show1').className = 'none';
    }
    if (visible == "5") {
        document.getElementById('show5').className = 'block';
        document.getElementById('show4').className = 'none';
        document.getElementById('show3').className = 'none';
        document.getElementById('show2').className = 'none';
        document.getElementById('show1').className = 'none';
    }
}

function ShowTable(rasdel) {
    go_litr(100);
    if (rasdel == "1")
        win = window.open("/_scripts/table.php", "myWindow", "toolbar=0,width=700,height=300");
    if (rasdel == "2")
        win = window.open("/_scripts/table_2.php", "myWindow", "toolbar=0,width=700,height=300");
    if (rasdel == "3")
        win = window.open("/_scripts/table_3.php", "myWindow", "toolbar=0,width=700,height=300");
    if (rasdel == "4")
        win = window.open("/_scripts/table_4.php", "myWindow", "toolbar=0,width=700,height=300");
    if (rasdel == "5")
        win = window.open("/_scripts/table_5.html", "myWindow", "toolbar=0,width=700,height=300");
}

function get_radio_value() {
    for (var i = 0; i < document.formsearch.browser.length; i++) {
        if (document.formsearch.browser[i].checked) {
            var rad_val = document.formsearch.browser[i].value;
        }
    }
}

function demo() {
    var i;
    if (window.intervalID !== undefined) {
        clearInterval(intervalID);
        intervalID = undefined;
        $('#demobut').val('Вкл. демо');
        $('#demobut').removeClass('stop_demo');
        $('#demobut').addClass('play_demo');

        //set_bg(1);
        //set_img(1);
        //chande_type(1);

        document.formsearch.browser[0].checked = true;
        document.formsearch.litr[2].checked = true;
    } else {
        $('#demobut').val('Выкл. демо');
        $('#demobut').removeClass('play_demo');
        $('#demobut').addClass('stop_demo');
        intervalID = setInterval(function () {
            i = Math.floor(Math.random() * 5 + 1);
            j = Math.floor(Math.random() * 11 + 1);
            k = Math.floor(Math.random() * 8 + 1);
            chande_type(i);
            set_bg(j);
            set_img(k);
            document.formsearch.browser[i - 1].checked = true;
            document.formsearch.litr[i].checked = true;
        }, 3500);
    }

}

