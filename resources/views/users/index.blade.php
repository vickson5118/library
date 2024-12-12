@extends('layouts.app')


@section('content')
    <!-- Liste des livres -->
    <div class="mt-10 p-10 relative w-9/12 mx-auto border-2">
        <p class="text-xl mb-5">Les utilisateurs</p>

        <div class="mx-auto min-w-full">
            <table class="table-layout: auto; min-w-full">
                <thead class="w-full">
                    <tr class="border-2 h-16">
                        <th class="w-2/12 text-center border-r-2">N°</th>
                        <th class="w-5/12 text-center border-r-2">Nom de l'auteur</th>
                        <th class="w-3/12 text-center border-r-2">Admin</th>
                        <th class="w-2/12 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="h-14 border-2">
                            <td class="hidden id"> {{ $user->id }} </td>
                            <td class="text-center border-r-2"> {{ $loop->iteration }} </td>
                            <td class="text-center border-r-2 name"> {{ $user->name }} </td>
                            <td class="text-center border-r-2 admin">

                                @if ($user->admin)
                                    <span class="bg-green-600 text-white px-4 py-2 rounded-lg font-bold">Oui</span>
                                @else
                                    <span class="bg-red-600 text-white px-4 py-2 rounded-lg font-bold">Non</span>
                                @endif

                            </td>
                            <td class="text-center">

                                @if (Auth::id() != $user->id)
                                    <a href="#updateUserAdminModal" rel="modal:open"
                                        class="no-underline text-[#4F46E5] font-bold btn-modal-update-admin-user">

                                        @if ($user->admin)
                                            Utilisateur
                                        @else
                                            Admin
                                        @endif

                                    </a>

                                    <a href="#deleteUserModal" rel="modal:open"
                                        class="no-underline text-red-600 font-bold block btn-modal-delete-user">Supprimer</a>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    @include('partials.modal-confirm-delete-action', [
        'name' => 'deleteUser',
    ])

    @include('partials.modal-confirm-delete-action', [
        'name' => 'updateUserAdmin',
    ])

    <script type="module">
        $(document).ready(function() {

            //Rendre un utilisateur administrateur
            $(".btn-modal-update-admin-user").on('click', function() {

                let id = $(this).parent().parent().find('.id').text().trim();
                let name = $(this).parent().parent().find(".name").text().trim();
                let admin = $(this).parent().parent().find(".admin").text().trim();

                if (admin === "Oui") {

                    $("#updateUserAdminModal #modal-texte").html(
                        "Etes-vous sûr(e) de vouloir definir l'administrateur <strong>" +
                        name + "</strong> comme un utilisateur standard ?")

                } else {

                    $("#updateUserAdminModal #modal-texte").html(
                        "Etes-vous sûr(e) de vouloir definir cet l'utilisateur <strong>" +
                        name + "</strong> comme un administrateur ?")

                }

                deleteTitleOnCategoryLanguageEditorOrAuthor("updateUserAdmin", "/users/update", id)

            })

            //supprimer un utilisateur
            $(".btn-modal-delete-user").on('click', function() {

                let id = $(this).parent().parent().find('.id').text().trim();
                let name = $(this).parent().parent().find(".name").text().trim();

                $("#deleteUserModal #modal-texte").html(
                    "Etes-vous sûr(e) de vouloir supprimer definitivement l'utilisateur <strong>" +
                    name + "</strong> ?")

                deleteTitleOnCategoryLanguageEditorOrAuthor("deleteUser", "/users/delete", id)

            })





        })
    </script>
@endsection
