var url = 'http://proyecto-laravel.com.devel/';

window.addEventListener("load", function() {

    $('.btn-like').css('cursor', 'pointer');
    $('.btn-dislike').css('cursor', 'pointer');

    //Boton de like
    function like() {
        $('.btn-like').unbind('click').click(function() { //unbind para que no acumule eventos
            $(this).addClass('btn-dislike').removeClass('btn-like');
            $(this).attr('src', url+'img/heart-red.png');

            $.ajax({
                url: url + '/like/' + $(this).data('id'),
                type: 'GET',
                success: function(res) {
                    if (res.like) {
                        console.log('Has dado like');
                    } else {
                        console.log('Error al dar like');
                    }
                }
            });
            dislike();
        });
    }
    like();

    //Boton de dislike
    function dislike() {
        $('.btn-dislike').unbind('click').click(function() { //unbind para que no acumule eventos
            $(this).addClass('btn-like').removeClass('btn-dislike');
            $(this).attr('src', url+'img/heart-gray.png');
            $.ajax({
                url: url + '/dislike/' + $(this).data('id'),
                type: 'GET',
                success: function(res) {
                    if (res.like) {
                        console.log('Has dado dislike');
                    } else {
                        console.log('Error al dar dislike');
                    }
                }
            });
            like();
        });
    }
    dislike();

    /**Buscador */
    $('#buscador').submit(function(){
        $(this).attr('action', url+'users/'+$('#buscador #search').val());
    });

});