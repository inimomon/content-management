<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite('resources/css/app.css')
</head>
<body class="h-screen w-full flex">
    <side class="w-72 h-full bg-purple-700 flex flex-col items-center py-8 px-4 gap-4">
        <h1 class="text-white text-xl font-semibold">Content Management</h1>
        <ul class="mt-20 flex flex-col items-center gap-10 text-white">
            <li><a href="{{route('content.index')}}">Home</a></li>
            <li><a href="{{route('content.create')}}">Tambah</a></li>
        </ul>
        <div class="grow"></div>
        <a class="w-full h-10 bg-red-400 text-white rounded-md flex justify-center items-center" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                            document.getElementById('logout-form').submit();">
            Logout
        </a>

        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </side>
    <main class="grow p-8">
        @yield('content')
    </main>
</body>
</html>