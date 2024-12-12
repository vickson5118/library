@extends('layouts.app')


@section('content')
    <!-- Liste des livres -->
    <div class="mt-10 p-10 relative w-9/12 mx-auto border-2">
        <p class="text-xl mb-5">Les langues</p>

        <a href="#createLanguageModal" rel="modal:open"
            class="no-underline bg-[#4F46E5] text-white font-bold block absolute px-8 py-3 rounded-md right-10 top-4">Ajouter</a>

        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="w-2/12 text-center border-r-2">N°</th>
                        <th class="w-7/12 text-center border-r-2">Titre de la langue</th>
                        <th class="w-3/12 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($languages as $language)
                        <tr class="h-14 border-2">
                            <td class="hidden id"> {{ $language->id }} </td>
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2 title"> {{ $language->title }} </td>
                            <td class="text-center">
                                <a href="#updateLanguageModal" rel="modal:open"
                                class="no-underline text-[#4F46E5] font-bold btn-modal-update-language">Editer</a>
                            <a href="#deleteLanguageModal" rel="modal:open"
                                class="no-underline text-red-600 font-bold block btn-modal-delete-language">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-add-new-title', [
        'name' => 'createLanguage',
        'modalText' => 'Ajouter une langue',
        'slug' => '',
    ])

    @include('partials.modal-add-new-title', [
        'name' => 'updateLanguage',
        'modalText' => 'Modifier la langue',
        'slug' => 'edit-',
    ])

    @include('partials.modal-confirm-delete-action', [
        'name' => 'deleteLanguage',
    ])

    <script type="module">
        $(document).ready(function() {

            //Ajouter une catégory
            addTitleOnCategoryLanguageEditor("createLanguage", "/languages/create");

            //Mise à jour d'une catégorie
            $(".btn-modal-update-language").on('click', function() {

                $("#updateLanguageModal .error").text("")

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#edit-title").val(title)

                updateTitleOnCategoryLanguageEditor("updateLanguage", "/languages/update", id);
            })

            //Suppression d'une catégorie
            $(".btn-modal-delete-language").on('click', function() {

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#deleteLanguageModal #modal-texte").html(
                    "Etes-vous sûr(e) de vouloir supprimer definitivement la langue <strong>" +
                    title + "</strong> ?")


                deleteTitleOnCategoryLanguageEditorOrAuthor("deleteLanguage", "/languages/delete", id);
            })



        })
    </script>
@endsection
