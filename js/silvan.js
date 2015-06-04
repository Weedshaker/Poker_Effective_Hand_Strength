/**
* replace links
*/
(function(Silvan, $, undefined){
    Silvan.init = function(){
        main(this);
    };
    main = function(public){
        public.CopyrightNotice = "(c) 2014 Silvan Strübi <silvan.struebi@gmail.com>, Poker HandStrength Algorithm";
        // table and player card checkbox switch
        var checkboxArray = ['input[value="tCardsActive"]', 'input[value="pCardsActive"]'];
        main.activeCheckbox = 'pCardsActive';
        for(i = 0; i < checkboxArray.length; i++){
            var y = i + 1;
            if(typeof checkboxArray[y] == 'undefined'){
                y = 0;
            }
            $(checkboxArray[i]).change(function(otherCheckbox){
                // http://robertnyman.com/2008/10/09/explaining-javascript-scope-and-closures/
                return function(){
                    if(this.checked){
                        $(otherCheckbox).prop("checked", 0);
                        main.activeCheckbox = $(this).val();
                    }else{
                        $(otherCheckbox).prop("checked", 1);
                        main.activeCheckbox = $(otherCheckbox).val();
                    }
                };
            }(checkboxArray[y]));
        }
        // move cards to table on click
        main.placeHolder = 'img/placeHolder.png';
        $('#allCards td').click(function(){
            var parentImg = $(this).find('img');
            if($(parentImg).attr('src') != main.placeHolder){
                $('#' + main.activeCheckbox + ' td').each(function(){
                    var thisImg = $(this).find('img');
                    if($(thisImg).attr('src') == main.placeHolder && $(this).find('input').length == 0){
                        // move image
                        $(thisImg).remove();
                        $(parentImg).clone().appendTo(this);
                        $(parentImg).attr('src', main.placeHolder);
                        main.ajax();
                        return false;
                    }
                });
            }
        });
        // move cards back to stack on click
        $('#tCardsActive td, #pCardsActive td').click(function(){
            var thisInput = $(this).siblings().find('input');
            // move checkbox
            if(!thisInput.checked){
                $(thisInput).prop('checked', true).trigger('change');
            }
            if($(this).find('img').attr('src') != main.placeHolder && $(this).find('input').length == 0){
                var thisImg = $(this).find('img');
                var thisData = $(thisImg).data('card');
                var thisSrc = $(thisImg).attr('src');
                // move image
                $(thisImg).remove();
                $(this).append('<img width="100" src="'+ main.placeHolder +'">');
                $('#allCards td img[data-card="'+ thisData +'"]').attr('src', thisSrc);
                main.ajax();
            }
        });
        // clear all cards
        $('#remove').click(function(){
            $('#tCardsActive td, #pCardsActive td').each(function(){
                $(this).trigger('click');
            });
        });
        // ajax
        main.ajax = function(){
            var pCards = [];
            $('#pCardsActive td img').each(function(){
                if($(this).data('card')){
                    pCards[pCards.length] = $(this).data('card');
                }
            });
            var tCards = [];
            $('#tCardsActive td img').each(function(){
                if($(this).data('card')){
                    tCards[tCards.length] = $(this).data('card');
                }
            });
            if(pCards.length == 2 && tCards.length >= 3){
                // loading animation
                $('#result').find('ul, h1, .windows8').remove();
                $('#result').append('<div class="windows8"><div class="wBall" id="wBall_1"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_2"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_3"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_4"><div class="wInnerBall"></div></div><div class="wBall" id="wBall_5"><div class="wInnerBall"></div></div></div>');
                $.ajax({
                    url: 'ajax.php',
                    type: 'post',
                    dataType: 'json',
                    cache: false,
                    data: {pCards: pCards, tCards: tCards, Ppot: $('input[value="Ppot"]').prop('checked'), Npot: $('input[value="Npot"]').prop('checked')},
                    success: function(data, status) {
                        if(data) {
                            main.output(data);
                        }
                    },
                    error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log('Details: ' + desc + '\nError:' + err);
                    }
                });
            }
        }
        // result output
        main.output = function(data){
            $('#result').find('ul, h1, .windows8').remove();
            $('#result').append('<h1></h1>').append('<ul></ul>');
            console.log(data);
            for(var key in data){
                if(data[key] != 0){
                    if(typeof data[key] !== 'object'){
                        if(key == 'handstrength'){
                            $('#result h1').html(key + ' - ' + data[key]);
                        }else{
                            $('#result ul').append('<li>' + key + ' - ' + data[key] + '</li>');
                        }
                    }else{
                        for(var key2 in data[key]['rates']){
                            //console.log(key2);
                            if(data[key]['rates'][key2] != 0){
                                $('#result ul').append('<li>' + key2 + ' - ' + data[key]['rates'][key2] + '</li>');
                            }
                        }
                    }
                }
            }
        }
    };
}(window.Silvan = window.Silvan || {}, jQuery));
/**
* initialize when DOM ready
*/
jQuery(document).ready(function(){
    Silvan.init();
});