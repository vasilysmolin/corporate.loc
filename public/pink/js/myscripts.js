jQuery(document).ready(function($){

    $( '#submit' ).click(function( event ) {
        event.preventDefault();

        $('.wrap_result').css('color','green').text('Сохранение комментария').fadeIn(500,function(){

            var data = $('#commentform').serializeArray();

            $.ajax({

                url:$('#commentform').attr('action'),
                data: data,
                type: 'POST',
                datatype: 'JSON',
                success: function(html){



                },
                error: function(){

                }
            })


        });


    });



    $('.commentlist li').each(function(i){

        $(this).find('div .commentNumber').text('#' + (i + 1));

    });



});