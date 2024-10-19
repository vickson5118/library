@extends('layouts.app')


@section('content')
    <!-- Liste des livres -->
    <div class="mt-10 p-10 relative w-9/12 mx-auto border-2">
        <p class="text-xl mb-5">Les categories</p>

        <a href="#createCategoryModal" rel="modal:open"
            class="no-underline bg-[#4F46E5] text-white font-bold block absolute px-8 py-3 rounded-md right-10 top-4">Ajouter</a>

        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="hidden">ID</th>
                        <th class="w-2/12 text-center border-r-2">N°</th>
                        <th class="w-7/12 text-center border-r-2">Titre de la catégorie</th>
                        <th class="w-3/12 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $category)
                        <tr class="h-14 border-2">
                            <td class="hidden id"> {{ $category->id }} </td>
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2 title"> {{ $category->title }} </td>
                            <td class="text-center">
                                <a href="#updateCategoryModal" rel="modal:open"
                                    class="no-underline text-[#4F46E5] font-bold btn-modal-update-category">Editer</a>
                                <a href="#deleteCategoryModal" rel="modal:open"
                                    class="no-underline text-red-600 font-bold block btn-modal-delete-category">Supprimer</a>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-add-new-title', [
        'name' => 'createCategory',
        'modalText' => 'Ajouter une catégorie',
        'slug' => '',
    ])

    @include('partials.modal-add-new-title', [
        'name' => 'updateCategory',
        'modalText' => 'Modifier la catégorie',
        'slug' => 'edit-',
    ])

    @include('partials.modal-confirm-delete-action', [
        'name' => 'deleteCategory',
    ])

    <script type="module">
        $(document).ready(function() {

            //Ajouter une catégory
            addTitleOnCategoryLanguageEditor("createCategory", "/categories/create");

            //Mise à jour d'une catégorie
            $(".btn-modal-update-category").on('click', function() {

                $("#updateCategoryModal .error").text("")

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#edit-title").val(title)

                updateTitleOnCategoryLanguageEditor("updateCategory", "/categories/update", id);
            })

            //Suppression d'une catégorie
            $(".btn-modal-delete-category").on('click', function() {

                let title = $(this).parent().parent().find('.title').text().trim();
                let id = $(this).parent().parent().find('.id').text().trim();

                $("#deleteCategoryModal #modal-texte").html(
                    "Etes-vous sûr(e) de vouloir supprimer definitivement la catégorie <strong>" +
                    title + "</strong> ?")


                deleteTitleOnCategoryLanguageEditorOrAuthor("deleteCategory", "/categories/delete", id);
            })



        })
    </script>
@endsection
