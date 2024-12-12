<h4 class="text-center w-full my-5 text-2xl font-bold py-6">
    {{ $book->exists ? 'Modifier un nouveau livre' : 'Ajouter un nouveau livre' }}</h4>

<form method="post" action="{{ $book->exists ? route('book.update', ['book' => $book]) : route('book.store') }}"
    class="bg-gray-300 min-h-max p-5 mb-16 w-11/12 mx-auto rounded-xl shadow-lg" novalidate enctype="multipart/form-data">
    @csrf

    @if ($book->exists)
        @method('patch')
    @else
        @method('post')
    @endif

    <div class="grid grid-cols-2">
        <div class="grid grid-cols-2">
            <x-input-group :label="__('Couverture')" :name="__('cover')" :type="__('file')" :value="$book->cover" :message="$errors->cover" />
            <x-input-group :label="__('Livre en PDF')" :name="__('pdf')" :type="__('file')" :value="$book->pdf" :message="$errors->pdf" />
        </div>
        <x-input-group :label="__('Titre du livre')" :name="__('title')" :type="__('text')" :value="$book->title" :message="$errors->title" />
        <x-input-group :label="__('Date de publication du livre')" :name="__('publication')" :type="__('date')" :value="$book->publication" :required="false"
            :message="$errors->publication" />
        <x-select-group :label="__('Maison d\'édition')" :name="__('publishing')" :options="$publishings" :value="$book->publishing_id"
            :message="$errors->editor" />
        <x-input-group :label="__('Nombre de pages')" :name="__('page')" :type="__('number')" :value="$book->page" :message="$errors->page"
            :required="false" />
        <x-select-group :label="__('Catégorie du livre')" :name="__('category')" :options="$categories" :value="$book->category_id"
            :message="$errors->categorie" />
        <x-select-group :label="__('Langue du livre')" :name="__('language')" :options="$languages" :value="$book->language_id"
            :message="$errors->language" />
        <x-select-group-multiple :label="__('Auteur(s)')" :name="__('author')" :options="$authors" :value="$book->authors()->pluck('id')"
            :message="$errors->author" />
        <x-input-group :label="__('Resumé du livre')" :name="__('summary')" :type="__('textarea')" :value="$book->summary" :message="$errors->summary"
            class="col-span-2" />

    </div>
    <x-primary-button class="mt-4"> {{ $book->exists ? 'Modifier le livre' : 'Ajouter le livre' }}</x-primary-button>

</form>

@include('partials.modal-add-new-title', [
    'name' => 'createPublishing',
    'modalText' => 'Ajouter une maison d\'édition',
    'slug' => 'publishing-'
])
@include('partials.modal-add-new-title', [
    'name' => 'CreateCategory',
    'modalText' => 'Ajouter une catégorie',
    'slug' => 'category-'
])
@include('partials.modal-add-new-title', [
    'name' => 'createLanguage',
    'modalText' => 'Ajouter une langue',
    'slug' => 'language-'
])
@include('partials.modal-add-new-author',['name' =>'addAuthor','slug'=>''])

<script type="module">
    $(document).ready(function() {

        addTitleOnCategoryLanguageEditorSelect("publishing","createPublishing", "publishings",)
        addTitleOnCategoryLanguageEditorSelect("language","createLanguage", "languages")
        addTitleOnCategoryLanguageEditorSelect("category","CreateCategory", "categories")

        $('select#author').selectize({
            plugins: {
                remove_button: {
                    title: "Supprimer"
                }
            },
            maxItems: null,
            create: function(input, callback) {
                $("#addAuthorModal").modal();

                $(".error").text("");
                $("#name").val(input)
                $("#about").val("")

                $("#addAuthor").on('submit', function(event) {
                    event.preventDefault();

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
                            $(".close-modal").trigger('click');
                            callback({
                                value: response.id,
                                text: response.name
                            })
                        },
                        error: function(response) {

                            if (response.responseJSON.errors != null) {
                                Object.entries(response.responseJSON.errors).forEach(([key, value]) => {
                                    $("#" + key).parent().find(".error").text(value)
                                    })
                            }


                        }
                    });
                });
            },

        })
    })
</script>
