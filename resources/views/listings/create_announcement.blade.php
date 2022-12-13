<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="icon" href="images/favicon.ico" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
            integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g=="
            crossorigin="anonymous"
            referrerpolicy="no-referrer"
        />
        <script src="//unpkg.com/alpinejs" defer></script>
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        colors: {
                            laravel: "MediumSeaGreen",
                            minsuY: "Blue",
                        },
                    },
                },
            };
        </script>
        <title>MinSU-Admin</title>
    </head>
    
    <body class="mb-48">
        <nav class="flex justify-between items-center mb-4">
            <a href="/admin/adminpage"
                ><img class="w-24" src="{{asset('images/minsu.png')}}" alt="" class="logo"
            /></a>
            <ul class="flex space-x-6 mr-6 text-lg">
                @auth
                <li>
                    <span class="font-bold uppercase">
                        Welcome Admin {{auth()->user()->name}}
                    </span>
                </li>
                <li>
                    <form class='inline' method="POST" action="/logout">
                    @csrf
                    <button type="submit" class="hover:text-laravel">
                        <i class="fa-solid fa-door-open"></i>Logout

                    </button>
                    </form>
                </li>

                @else

                <li>
                    <a href="/register" class="hover:text-laravel"
                        ><i class="fa-solid fa-user-plus"></i> Register</a
                    >
                </li>
                <li>
                    <a href="/login" class="hover:text-laravel"
                        ><i class="fa-solid fa-arrow-right-to-bracket"></i>
                        Login</a
                    >
                </li>     
                @endauth
            </ul>     
        </nav>
<x-flash-message/>
<section
class="relative h-72 bg-laravel flex flex-col justify-center align-center text-center space-y-4 mb-4"
>
<div
    class="absolute top-0 left-0 w-full h-full opacity-10 bg-no-repeat bg-center"
    style="background-image: url('/images/minsu-logo.png')" 
></div>

<div class="z-10">
    <h1 class="text-6xl font-bold text-white">
        MinSU - Admin
    </h1>
    <p class="text-2xl text-gray-200 font-bold my-4">
        Welcome to Mindoro State University
    <div>
        <a
        href="/admin/admin_announcement"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
        >Announcement</a
         >

        <a
            href="/listings/create_announcement"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Post Announcement</a
        >

        <a
            href="/admin/admin_job_manage"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Manage Announcement</a
        >

        <a
        href="/admin/adminpage"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
        >Home</a
         >
    </div>
</div>
</section>

  <x-card class="p-10 max-w-lg mx-auto mt-24"
                    >
                        <header class="text-center">
                            <h2 class="text-2xl font-bold uppercase mb-1">
                                Post an Announcement
                            </h2>                            
                        </header>
                        <form method="POST" action="/announcements" enctype="multipart/form-data">
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
</body>
</html>     


