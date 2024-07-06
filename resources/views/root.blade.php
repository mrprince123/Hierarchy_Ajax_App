<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chetu Hierarchy : Home</title>
    {{-- Tailwind CLI  --}}
    @vite('resources/css/app.css')
</head>

<body>

    <div class="relative h-screen">
        <img class="h-screen w-full object-cover"
            src="https://images.unsplash.com/photo-1505409859467-3a796fd5798e?q=80&w=1470&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D"
            alt="Random image">
        <div class="absolute inset-0 bg-teal-500 opacity-60 rounded-md"></div>
        <div class="absolute inset-0 flex flex-col items-center justify-center w-3/5 m-auto">
            <h2 class="text-white text-3xl font-bold m-2 uppercase">Welcome to Chetu Hierarchy</h2>
            <p class="text-white text-lg m-2 text-center font-medium">Welcome to the Chetu Hierarchy website, Please
                select any
                option according
                to your need to continue and explore the beauty of this website which is build using Laravel</p>
            <div class="flex gap-4 m-2">
                <a href="{{ route('employee.login') }}"
                    class="text-white p-2 rounded-2xl font-semibold text-xl border-2 border-orange-500">Employee
                    Login</a>
                <a href="{{ route('admin.login') }}"
                    class="text-white p-2 rounded-2xl font-semibold text-xl border-2 border-orange-500">Admin Login</a>
            </div>
        </div>
    </div>
</body>

</html>
