(function ($) {
    "use strict";

    function dispatch() {
        $(".import-navigation form").submit(function(e){
            var form = this;
            var parent = $(this).parent();
            var overlay = $(parent).find('.import-overlay');
            $(overlay).show();

            var do_data_array = function(data){
                var result = { };
                $.each(data, function(){
                    result[this.name] = this.value;
                });
                return result;
            };

            var do_ajax = function(data){
                var data_array = do_data_array(data);
                if(data_array['type'] === 'content') {
                    $(overlay).find('p').text('Importing Content ..');
                } else if(data_array['type'] === 'setting') {
                    $(overlay).find('p').text('Importing Setting ..');
                }
                $.ajax({
                    url: joption.adminurl,
                    type: "post",
                    data: $.param(data),
                    timeout: 3600000,
                    success: function (result) {
                        if(result === '') {
                            alert('Import Finished');
                            $(overlay).hide();
                        } else {
                            alert(result);
                            $(overlay).hide();
                        }
                    }
                });

            };

            do_ajax($(form).serializeArray());
            return false;
        });
    }

    // document ready to dispatch
    $(document).ready(dispatch);

})(jQuery);