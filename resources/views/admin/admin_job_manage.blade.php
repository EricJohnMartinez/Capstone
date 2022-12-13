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
            href="/admin/admin_job"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Job</a
        >
        <a
            href="/admin/admin_job_create"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >List a Job</a
        >
        
        <a
            href="/admin/admin_job_manage"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Manage Job</a
        >

        <a
        href="/admin/adminpage"
        class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
        >Home</a
         >

    </div>
</div>
</section>

  <x-card class="p-10">
    <header>
        <h1
            class="text-3xl text-center font-bold my-6 uppercase"
        >
            Manage All Job Posted
        </h1>
    </header>

    <table class="w-full table-auto rounded-sm">
        <tbody>
            @unless($listings->isEmpty())
            @foreach ($listings as $listing)
       
            <tr class="border-gray-300">
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a>
                        {{$listing->title}}
                    </a>
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                    <a
                        href="/list/{{$listing->id}}/edit"
                        class="text-blue-400 px-6 py-2 rounded-xl"
                        ><i
                            class="fa-solid fa-pen-to-square"
                        ></i>
                        Edit</a
                    >
                </td>
                <td
                    class="px-4 py-8 border-t border-b border-gray-300 text-lg"
                >
                <form method="POST" action="/list/{{$listing->id}}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>
                        Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
            @else
            <tr class="borded-gray-300">
                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                    <p class="text-center">No Job Posted</p>
                </td>
            </tr>
            @endunless
        </tbody>
    </table>
</x-card>
</body>
</html>     