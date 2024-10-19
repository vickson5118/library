@extends('layouts.app')


@section('content')
    <!-- Liste des livres -->
    <div class="mt-10 p-10 relative w-9/12 mx-auto border-2">
        <p class="text-xl mb-5">Les auteurs</p>

        <a href="#createAuthorModal" rel="modal:open"
            class="no-underline bg-[#4F46E5] text-white font-bold block absolute px-8 py-3 rounded-md right-10 top-4">Ajouter</a>

        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="hidden">N°</th>
                        <th class="w-1/12 text-center border-r-2">N°</th>
                        <th class="w-3/12 text-center border-r-2">Nom de l'auteur</th>
                        <th class="w-6/12 text-center border-r-2">A propos de l'auteur</th>
                        <th class="w-2/12 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($authors as $author)
                        <tr class="h-14 border-2">
                            <td class="hidden id"> {{ $author->id }} </td>
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2 name"> {{ $author->name }} </td>
                            <td class="text-justify border-r-2 p-3 about"> {{ $author->about }} </td>
                            <td class="text-center">
                                <a href="#updateAuthorModal" rel="modal:open"
                                    class="no-underline text-[#4F46E5] font-bold btn-modal-update-author">Editer</a>
                                <a href="#deleteAuthorModal" rel="modal:open"
                                    class="no-underline text-red-600 font-bold block btn-modal-delete-author">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-add-new-author', [
        'name' => 'createAuthor',
        'slug' => '',
    ])
    @include('partials.modal-add-new-author', [
        'name' => 'updateAuthor',
        'slug' => 'edit-',
    ])

    @include('partials.modal-confirm-delete-action', [
        'name' => 'deleteAuthor',
    ])

    <script type="module">
        $(document).ready(function() {

            /*Ajout d'un auteur*/
            $("#createAuthor").on('submit', function(event) {
                event.preventDefault();
                $('.error').text("");
                let data = new FormData(this);
                $.ajax({
                    method: 'post',
                    url: '/authors/create',
                    dataType: 'json',
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                            'content')
                    },
                    data: data,
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {

                        if (response.responseJSON.errors != null) {
                            Object.entries(response.responseJSON.errors).forEach(([key,
                                value
                            ]) => {
                                $("#" + key).parent().find(".error").text(value)
                            })
                        }


                    }
                });
            });

            /*Modification d'un auteur*/
            $(".btn-modal-update-author").on('click', function() {

                $('.error').text("");
                let id = $(this).parent().parent().find('.id').text().trim();
                $("#edit-name").val($(this).parent().parent().find(".name").text().trim())
                $("#edit-about").val($(this).parent().parent().find(".about").text().trim())

                $("#updateAuthor").on('submit', function(event) {
                    event.preventDefault();
                    $('.error').text("");

                    let data = new FormData(this);
                    data.append('id', id);

                    $.ajax({
                        method: 'post',
                        url: '/authors/update',
                        dataType: 'json',
                        processData: false,
                        contentType: false,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr(
                                'content')
                        },
                        data: data,
                        success: function(response) {
                            if (response.success != null) {
                                location.reload()
                            }
                        },
                        error: function(response) {

                            if (response.responseJSON.errors != null) {
                                Object.entries(response.responseJSON.errors).forEach(([
                                    key,
                                    value
                                ]) => {
                                    $("#" + key).parent().find(".error")
                                        .text(
                                            value)
                                })
                            }


                        }
                    });
                });
            })

            //supprimer un autheur
            $(".btn-modal-delete-author").on('click', function() {

                let id = $(this).parent().parent().find('.id').text().trim();
                let name = $(this).parent().parent().find(".name").text().trim();

                $("#deleteAuthorModal #modal-texte").html(
                    "Etes-vous sûr(e) de vouloir supprimer definitivement l'auteur <strong>" +
                    name + "</strong> ?")

                deleteTitleOnCategoryLanguageEditorOrAuthor("deleteAuthor","/authors/delete",id)

            })





        })
    </script>
@endsection
