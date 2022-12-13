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
            href="/admin/admin_job"
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
<form action="/admin/admin_job">
    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
        <div class="absolute top-4 left-3">
            <i
                class="fa fa-search text-gray-400 z-20 hover:text-gray-500"
            ></i>
        </div>
        <input
            type="text"
            name="search"
            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
            placeholder="Search MinSU"
        />
        <div class="absolute top-2 right-2">
            <button
                type="submit"
                class="h-10 w-20 text-white rounded-lg bg-green-500 hover:bg-blue-600"
            >
                Search
            </button>
        </div>
    </div>
  </form>
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
</body>
</html>     