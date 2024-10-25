<nav class="w-full">
    <div class="bg-[#2a2e32] fixed top-0 bottom-0 left-0 w-72 overflow-auto">

        <div class="bg-[#596643] min-h-24 w-full">
            <div class="flex items-center relative">
                @auth
                    <img src="" alt=""
                         class="bg-white min-h-16 w-16 rounded-full relative top-4 left-8 inline-block">
                    <a href="{{ route('profile.edit') }}"
                       class="text-white text-lg ml-12 mt-8">{{  Auth::user()->name }}</a>
                @endauth
            </div>
        </div>

        <div class="left-menu-container">

            <div class="mt-16 px-8">

                <a href="/" class="block text-white text-center text-le p-2 hover:bg-gray-500 rounded-2xl">
                    <i class="bi bi-files text-2xl"></i>
                    <span class="ml-2">Documents</span>
                </a>

                <a href="{{ route('book.index.borrow') }}"
                   class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                    <i class="bi bi-file-earmark-plus-fill text-2xl"></i>
                    <span class="ml-2">Livres empruntés</span>
                </a>


                @auth
                    @if(Auth::user()->admin)
                        <a href="{{ route('book.create') }}"
                           class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-file-earmark-plus-fill text-2xl"></i>
                            <span class="ml-2">Ajouter un livre</span>
                        </a>
                    @endif
                @endauth


            </div>

            <div class="mt-10 px-8">

                @auth

                    @if(Auth::user()->admin)
                        <div class="border-b-2 w-52 mx-auto mt-10"></div>

                        <a href="{{ route('author.index') }}"
                           class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-folder-plus text-2xl"></i>
                            <span class="ml-2">Les auteurs</span>
                        </a>

                        <a href="{{ route('publishing.index') }}"
                           class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-folder-plus text-2xl"></i>
                            <span class="ml-2">Les editeurs</span>
                        </a>

                        <a href="{{ route('category.index') }}"
                           class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-folder-plus text-2xl"></i>
                            <span class="ml-2">Les categories</span>
                        </a>

                        <a href="{{ route('language.index') }}"
                           class="block text-white text-center p-2 mt-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-folder-plus text-2xl"></i>
                            <span class="ml-2">Les Langues</span>
                        </a>

                        <a href="{{ route('user.index') }}"
                           class="block text-white text-center p-2 hover:bg-gray-500 rounded-2xl">
                            <i class="bi bi-person-plus-fill text-2xl"></i>
                            <span class="ml-2">Les utilisateurs</span>
                        </a>
                    @endif
                @endauth


                <div class="border-b-2 w-52 mx-auto mt-5"></div>

                @guest
                    <a href="{{ route('login') }}"
                       class="block text-white text-center p-2 hover:bg-gray-500 rounded-2xl mt-4">
                        <i class="bi bi-person-circle text-2xl"></i>
                        <span class="ml-2">Se connecter</span>
                    </a>
                @endguest

            </div>


            @auth
                <form action="{{ route('logout') }}" method="post" class="mt-6 ml-7">
                    @csrf
                    @method('post')

                    <button type="submit"
                            class="block text-white text-center text-md py-2 px-12 hover:bg-gray-500 rounded-2xl">
                        <i class="bi bi-door-open-fill text-2xl text-[#596643]"></i>
                        <span class="ml-2">Deconnexion</span>
                    </button>

                </form>
            @endauth


        </div>


    </div>

</nav>
