jQuery(document).ready(function($) {
   $('#popup_ok').click(function() {
       $('#popup').hide();
    });
    var popup = $('#popup');


    popup.hide();

    $('form').submit(function(e) {
       var form = $(this);
       form.css('opacity', 0);
       $('#content').html('Loading');
       popup.show();
       var select_id = $('#select_type')[0].selectedIndex;
       var selected_type = $('#select_type :nth-child(' + (++select_id) + ')').val();
       var model_id = $('#select_model')[0].selectedIndex;
       var model = $('#select_model :nth-child(' + (++model_id) + ')').val();
       $.ajax({
               url:'?action='+model,
               method:selected_type,
               data: {
                   params: {
                        country: $('#country').val(),
                        description: $('#description').val(),
                        name: $('#name').val(),
                        id: $('#id').val()
                   }
               },
               dataType: 'json',
               error: function(err, desc) {
                   form.css('opacity', 1);
                   console.log(err, desc);
                   $('#content').html(desc);
               },
               success: function(data) {
                   form.css('opacity', 1);
                   console.log(data);
                   if (data.hasOwnProperty('items')) {
                       var items = data.items;
                       var model_id = $('#select_model')[0].selectedIndex;
                       var model = $('#select_model :nth-child(' + (++model_id) + ')').html();
                       var text = "";
                       for (var i=0; i<items.length; i++) {
                           text += "<div class='item'>"+items[i].name+"</div>";
                       }
                       $('#head').html(model);
                       $('#content').html(text);
                   } else {
                        $('#content').html('Successfull');
                   }
               }
           }
       );
       return false;
    });
});