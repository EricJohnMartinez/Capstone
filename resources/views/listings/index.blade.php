<x-layout>
    @include('partials._hero')
    @include('partials._search')

    <div
    class="lg:grid lg:grid-cols-1 gap-4 space-y-4 md:space-y-0 mx-4">
    @unless (count($list)==0)
    @foreach($list as $listing)
     <x-listing-card :listing="$listing" />
    @endforeach  
    @else
    <p> No List Found</p>
    @endunless
</div>
<div class="mt-6 p-4">
    {{$list->links()}}
</div>

    <footer
    class="fixed bottom-0 left-0 w-full flex items-center justify-start font-bold bg-laravel text-white h-10 mt-12 opacity-90 md:justify-center"
>
    <a
        href="/listings/create_announcement"
        class="absolute top-1/3 right-10 bg-minsuY text-white py-0.5 px-3"
        >Post an Announcement</a
    >
</footer>
</x-layout>