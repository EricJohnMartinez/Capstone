<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">

    <title>MinSU</title>

</head>
<body>
    {{--nav--}}
    <nav class="flex items-center justify-between p-4 bg-gray-800 text-white">
        <div class="flex items-center">
          <a href="#"><img src="{{asset('images/minsu.png')}}" alt="Logo" class="w-20 h-20 mr-4">
          </a>
            <h2 class="text-xl font-medium">{{auth()->user()->name}}</h2>
          <input type="text" class="bg-gray-700 ml-4 rounded-full px-4 py-2 text-sm focus:outline-none focus:shadow-outline w-64" placeholder="Search">
          <button class="bg-gray-300 text-gray-700 rounded-full px-3 py-2 ml-4">Search</button>
        </div>
        <div class="flex items-center">
          <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 rounded-full">Profile</a>
          <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 rounded-full ml-4">Settings</a>
          <a href="#" class="block px-4 py-2 text-sm text-white hover:bg-gray-700 rounded-full ml-4">Logout</a>
        </div>
      </nav>
{{--post--}}
      

          <div class="w-96 mx-auto my-4 p-4 bg-white rounded-lg shadow-lg">
          <button
          class="bg-gray-300 text-gray-700 rounded-full px-3 py-2 mt-4"> <a href="/listings/feed_post">Add a Post</a> </button>
        </div>

    
      {{--card--}}
      <div class="w-96 mx-auto my-4 p-4 bg-white rounded-lg shadow-lg">
       
        @unless (count($social_media) == 0)
        @foreach ($social_media as $social )
        <img src="image.png" alt="Image" class="w-full h-64 object-cover rounded-t-lg">
        <div class="px-4 py-4">
  
          <p class="text-xs text-gray-700 mt-2"> {{$social->post}}</p>
        </div>
        <div class="px-4 py-2">
          <button class="bg-gray-300 text-gray-700 rounded-full px-3 py-2">Like</button>
          <input type="text" class="bg-gray-300 text-gray-700 rounded-full px-3 py-2 ml-4" placeholder="Type a comment...">
        </div>
        @endforeach
        @else
        <p>No eMe</p>
        @endunless
      </div>
     
</body>
</html>