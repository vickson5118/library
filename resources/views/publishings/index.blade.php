@extends('layouts.app')


@section('content')
    <!-- Liste des livres -->
    <div class="mt-10 p-10 relative w-9/12 mx-auto border-2">
        <p class="text-xl mb-5">Les éditeurs</p>

        <a href="#createPublishingModal" rel="modal:open"
            class="no-underline bg-[#4F46E5] text-white font-bold block absolute px-8 py-3 rounded-md right-10 top-4">Ajouter</a>

        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="hidden">ID</th>
                        <th class="w-2/12 text-center border-r-2">N°</th>
                        <th class="w-6/12 text-center border-r-2">Nom de l'éditeur</th>
                        <th class="w-4/12 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($publishings as $publishing)
                        <tr class="h-14 border-2">
                            <td class="hidden id"> {{ $publishing->id }} </td>
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2 title"> {{ $publishing->title }} </td>
                            <td class="text-center">
                                <a href="#updatePublishingModal" rel="modal:open"
                                    class="no-underline text-[#4F46E5] font-bold btn-modal-update-publishing">Editer</a>
                                <a href="#deletePublishingModal" rel="modal:open"
                                    class="no-underline text-red-600 font-bold block btn-modal-delete-publishing">Supprimer</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-add-new-title', [
        'name' => 'createPublishing',
        'modalText' => 'Ajouter une maison d\'édition',
        'slug' => '',
    ])

    @include('partials.modal-add-new-title', [
        'name' => 'updatePublishing',
        'modalText' => 'Modifier la maison d\'édition',
        'slug' => 'edit-',
    ])

    @include('partials.modal-confirm-delete-action', [
        'name' => 'deletePublishing',
    ])

    <script type="module">
        $(document).ready(function() {

            //Ajouter une maision d'édition
            addTitleOnCategoryLanguageEditor("createPublishing", "/publishings/create");

            //Mise à jour d'une maison d'édition
            $(".btn-modal-update-publishing").on('click', function() {

                $("#updatePublishingModal .error").text("")

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#edit-title").val(title)

                updateTitleOnCategoryLanguageEditor("updatePublishing", "/publishings/update", id);
            })

            //Suppression d'une maison d'édition
            $(".btn-modal-delete-publishing").on('click', function() {

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#deletePublishingModal #modal-texte").html(
                    "Etes-vous sûr(e) de vouloir supprimer definitivement la maison d'édition <strong>" +
                    title + "</strong> ?")


                deleteTitleOnCategoryLanguageEditorOrAuthor("deletePublishing", "/publishings/delete", id);
            })



        })
    </script>
@endsection
