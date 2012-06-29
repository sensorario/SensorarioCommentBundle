!function( $ ){
    $.fn.SensorarioComments = function(){

        var SensorarioComments = $(this);

        SensorarioComments.reloadForm = function (formConCommento) {
            var fieldCommentId = 'textarea#sensorario_commentbundle_commenttype_comment';
            var submitButtonId = '#sensorario_comment_form_button_submit';
            var formCommento = '#sensorario_comment_form_form';
            $.ajax({
                url: sensorario_comments_index,
                success: function (data) {
                    formConCommento.html(data);
                    $(submitButtonId).click(function(){
                        $.post(sensorario_comment_create, 
                        $(formCommento).serialize(), function (data) {
                            $.ajax({
                                url: sensorario_comments_comments,
                                success: function (data) {
                                    SensorarioComments.reloadComments();
                                    $(fieldCommentId).val('');
                                    $(fieldCommentId).focus();
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
                                    $('#sensorario_comment_tr_' + id_commento).fadeOut();
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