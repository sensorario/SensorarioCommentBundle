!function( $ ){
    $.fn.SensorarioComments = function(){

        var SensorarioComments = $(this);

        SensorarioComments.reloadForm = function (formConCommento) {
            $.ajax({
                url: sensorario_comments_index,
                success: function (data) {
                    formConCommento.html(data);
                    $('#sensorario_comment_form_button_submit')
                    .click(function(){
                        $.post(sensorario_comment_create, 
                            $("#sensorario_comment_form_form")
                            .serialize(), function (data) {
                                $.ajax({
                                    url: sensorario_comments_comments,
                                    success: function (data) {
                                        SensorarioComments.reloadComments();
                                        $('textarea#sensorario_comment_form_comment').val('');
                                        $('textarea#sensorario_comment_form_comment').focus();
                                    }
                                });
                            });
                    });
                }
            });
        }

        SensorarioComments.reloadComments = function () {
            $.ajax({
                url: sensorario_comments_comments,
                success: function (data) {
                    console.log('readed comments');
                    $('.SensorarioCommentsComments').html(data);
                    $('.SensorarioCommentsDelete').each(function(){
                        
                        var link_commento = $(this).attr('id');
                        var id_commento = $(this).attr('data');
                        var link_commento_href = $(this).attr('href') + '/' + id_commento;
                        
                        $(this).attr('href', 'javascript:return false;');
                        
                        $('#' + link_commento).click(function(){
                            $.ajax({
                                url: link_commento_href,
                                success: function (data) {
                                    SensorarioComments.reloadComments();
                                }
                            });
                        });
                    });
                }
            });
        }
        
        return this.each(function() {
            SensorarioComments.reloadComments();
            SensorarioComments.reloadForm($(this));
        });
    };
    
    $(function () {
        $('.SensorarioComments').SensorarioComments();
    });
}( window.jQuery )