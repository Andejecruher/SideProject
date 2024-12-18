<x-layouts.base>

    @if(in_array(request()->route()->getName(), [
    'dashboard',
    'profile',
    'users-list',
    'users.edit',
    'users.create',
    'categories-list',
    'categories.edit',
    'categories.create',
    'articles-list',
    'articles.edit',
    'articles.create',
    'articles.show',
    'tags-list',
    'tags.edit',
    'tags.create',
    'comments-list',
    'comments.show',
    'roles.index',
    'roles.create',
    'roles.edit',
    ]))

    {{-- Nav --}}
    @include('layouts.nav')
    {{-- SideNav --}}
    @include('layouts.sidenav')
    <main class="content">
        {{-- TopBar --}}
        @include('layouts.topbar')
        {{ $slot }}
        {{-- Footer --}}
        @include('layouts.footer')
    </main>

    @elseif(in_array(request()->route()->getName(), ['register', 'login','forgot-password','reset-password']))

    {{ $slot }}
    {{-- Footer --}}
    @include('layouts.footer2')


    @elseif(in_array(request()->route()->getName(), ['404', '500', 'lock']))

    {{ $slot }}

    @endif
</x-layouts.base>