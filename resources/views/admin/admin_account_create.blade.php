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
            href="/admin/admin_account"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Accounts</a
         >

        <a
            href="/admin/admin_account_create"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Create Account</a
        >

        <a
            href="/admin/admin_manage_account"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Manage Accounts</a
        >

        <a
            href="/admin/adminpage"
            class="inline-block border-2 border-white text-white py-2 px-4 rounded-xl mt-2 hover:text-black hover:border-black"
            >Home</a
        >
    </div>
</div>
</section>
<x-card class=" p-10 max-w-lg mx-auto mt-24">
    <header class="text-center">
        <h2 class="text-2xl font-bold uppercase mb-1">
            Create Account
        </h2>
        <p class="mb-4">Create an account</p>
    </header>

    <form method="POST" action="/users">
        @csrf
        <div class="mb-6">
            <label for="name" class="inline-block text-lg mb-2">
                Name
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="name"
                value="{{old('name')}}"
            />
            @error('name')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="role" class="inline-block text-lg mb-2"
                >Account Role</label>
            <select
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="role"
                value="{{old('role')}}"
            >
            <option value="alumni">Alumni</option>
            <option value="employer">Employer</option>
            <option value="admin">Admin</option>
            </select>
            @error('role')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="id_number" class="inline-block text-lg mb-2">
                ID Number
            </label>
            <input
                type="text"
                class="border border-gray-200 rounded p-2 w-full"
                name="id_number"
                value="{{old('id_number')}}"
            />

            @error('id_number')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label for="email" class="inline-block text-lg mb-2"
                >Email</label
            >
            <input
                type="email"
                class="border border-gray-200 rounded p-2 w-full"
                name="email"
                value="{{old('email')}}"
            />

            @error('email')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="password"
                class="inline-block text-lg mb-2"
            >
                Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password"
                value="{{old('password')}}"
            />
            @error('password')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <label
                for="password2"
                class="inline-block text-lg mb-2"
            >
                Confirm Password
            </label>
            <input
                type="password"
                class="border border-gray-200 rounded p-2 w-full"
                name="password_confirmation"
                value="{{old('password_confirmation')}}"
            />
            @error('password_conf')
            <p class="text-red-500 text-xs mt-1">{{$message}}</p>
            @enderror
        </div>

        <div class="mb-6">
            <button
                type="submit"
                class="bg-laravel text-white rounded py-2 px-4 hover:bg-black"
            >
                Sign Up
            </button>
        </div>

        <div class="mt-8">
            <p>
                Already have an account?
                <a href="/login" class="text-laravel"
                    >Login</a
                >
            </p>
        </div>
    </form>
   </x-card>
</body>
</html>     