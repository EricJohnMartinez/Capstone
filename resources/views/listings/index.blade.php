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

</x-layout>