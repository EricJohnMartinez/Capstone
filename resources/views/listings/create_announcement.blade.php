<x-layout>
    <x-card class="p-10 max-w-lg mx-auto mt-24"
                    >
                        <header class="text-center">
                            <h2 class="text-2xl font-bold uppercase mb-1">
                                Post an Announcement
                            </h2>                            
                        </header>
                        <form method="POST" action="/announcement" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-6">
                                <label for="title" class="inline-block text-lg mb-2"
                                    >Announcement Title</label
                                >
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="title"
                                    placeholder="Title   "
                                    value="{{old('title')}}"
                                />
                                @error('title')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    

                            <div class="mb-6">
                                <label for="tags" class="inline-block text-lg mb-2">
                                    Tags (Comma Separated)
                                </label>
                                <input
                                    type="text"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="tags"
                                    placeholder="Tags"
                                    value="{{old('tags')}}"
                                    />
    
                                @error('tags')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>

                           
                           <div class="mb-6">
                                <label for="media" class="inline-block text-lg mb-2">
                                    Insert Media
                                </label>
                                <input
                                    type="file"
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="media"
                                />
                                @error('media')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <label
                                    for="description"
                                    class="inline-block text-lg mb-2"
                                >
                                    Announcement Description
                                </label>
                                <textarea
                                    class="border border-gray-200 rounded p-2 w-full"
                                    name="descript"
                                    rows="10"
                                    placeholder="Announcement Description"
    
                                >{{old('descript')}}</textarea>
                                @error('descript')
                                <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                                @enderror
                            </div>
    
                            <div class="mb-6">
                                <button
                                    class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
                                >
                                    Post Announcement
                                </button>
                                <a href="/" class="text-black ml-4"> Back </a>
                            </div>
                        </form>
    </x-card>
    </x-layout>