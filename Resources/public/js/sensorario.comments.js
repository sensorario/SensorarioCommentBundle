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