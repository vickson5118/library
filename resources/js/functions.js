//Select dans le formulaire de creation
window.addTitleOnCategoryLanguageEditorSelect = function (select, name, lien) {
    $('select#' + select).selectize({
        create: function (input, callback) {
            $("#" + name + "Modal").modal();

            $("#" + select + "-title").val(input)

            $("#" + name).on('submit', function (event) {
                event.preventDefault();
                $.ajax({
                    method: 'post',
                    url: '/' + lien + '/create',
                    dataType: 'json',
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        'title': $("#" + select + "-title").val()
                    },
                    success: function (response) {
                        $(".close-modal").trigger('click');
                        callback({ value: response.id, text: response.title })
                    },
                    error: function (response) {
                        $('#' + name + 'Modal .error').text(response.responseJSON.message)
                    }
                });
            });
        },
    });

}

//Ajout dans la partie admin
window.addTitleOnCategoryLanguageEditor = function (name, link) {

    $("#" + name).on('submit', function (event) {

        event.preventDefault();
        $("#" + name + " .error").text("")

        $.ajax({
            method: 'post',
            url: link,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'title': $("#title").val()
            },
            success: function () {
                location.reload();
            },
            error: function (response) {
                $('#' + name + ' .error').text(response.responseJSON.message)
            }
        });
    });

}

window.updateTitleOnCategoryLanguageEditor = function (name, link, id) {

    $("#" + name).on('submit', function (event) {

        event.preventDefault();
        $("#" + name + " .error").text("")

        $.ajax({
            method: 'post',
            url: link,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: {
                'title': $("#edit-title").val(),
                'id': id
            },
            success: function () {
                location.reload();
            },
            error: function (response) {
                $('#' + name + ' .error').text(response.responseJSON.message)
            }
        });
    });
}

window.deleteTitleOnCategoryLanguageEditorOrAuthor = function (name, link, id) {

    $("#" + name).on('submit', function (event) {

        event.preventDefault();

        $.ajax({
            method: 'post',
            url: link,
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                    'content')
            },
            data: {
                'id': id
            },
            success: function (response) {
                if (response.success != null) {
                    location.reload()
                }
            },
            error: function () {
                location.reload()
            }
        });
    });
}
