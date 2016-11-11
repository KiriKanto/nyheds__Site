$(document).ready(function () {
   $(document).on('change', '#choose_this', function() {
       var value = $(this).val();
       not_editors(value);
       editors(value);
   });
});

function not_editors(selected){
    $.ajax({
         url:   '../select_categori_ajax.php',
        type:   'POST',
    dataType:   'json',
        data:   {value: selected},
      success: function (data) {
          var output = [];
          $.each(data, function(key, values)
          {
              output.push('<option value="' + values.user_id + '">' + values.user_name + '</option>');
          });
          $('#not_Editor').html(output.join(''))
      },
      error:function () {
          console.log("not editor virker ikke");
      }
    });
}
function editors(selected) {
    $.ajax({
        url:   '../select_editor_ajax.php',
        type:   'POST',
        dataType:   'json',
        data:   {value: selected},
        success: function (data) {
            var output = [];
            $.each(data, function(key, values)
            {
                output.push('<option value="' + values.user_id + '">' + values.user_name + '</option>');
            });
            $('#editor').html(output.join(''))
        },
        error:function () {
            console.log("editor virker ikke");
        }
    });
}
$(document).ready(function () {
    $(document).on('click', '#add_editor', function () {
        var value = $('#not_Editor').val();
        make_editor(value);

    });
});

function make_editor(selected) {
   var choosen_id = $('#choose_this').val();
    $.ajax({
        url:        '../make_editor.php',
        type:       'POST',
        dataType:   'json',
        data:       {value: selected, category: choosen_id},
        success: function (data) {
            if (data.status === true)
            {
                not_editors(choosen_id);
                editors(choosen_id);
            }
        }
    });

}
$(document).ready(function () {
   $(document).on('click', '#remove_editor',
   function () {
       var remove = $('#editor').val();
       remove_editor(remove);
   });
});
function remove_editor(selected) {
    var category_id = $('#choose_this').val();
    $.ajax({
        url: '../remove_editor.php',
        type: 'POST',
        dataType: 'json',
        data: {remove: selected, category: category_id},
        success: function (data) {
            if(data.status === true)
            {
                not_editors(category_id);
                editors(category_id);
            }
        }
    });
}
