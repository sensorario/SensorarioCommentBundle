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
                        var link_commento_href = $(this).attr('href');
                        $(this).attr('href', 'javascript:return false;');
                        $('#' + link_commento).click(function(){
                            console.log('Adesso apro ' + link_commento_href);
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