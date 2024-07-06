<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-slate-100">
    <div class="border border-1 bg-white rounded-xl p-4 w-1/4 mt-10 m-auto">

        <h1 class="font-bold text-xl text-teal-500 text-center mb-2">Login Here</h1>

        @if (Session::has('success'))
            <div id="success_message" class="p-2 border-green-500 bg-green-50 rounded-lg text-green-500 text-center">
                {{ Session::get('success') }}</div>
        @endif

        @if (Session::has('error'))
            <div id="error_message" class="p-2 border-red-500 bg-red-50 rounded-lg text-red-500 text-center">
                {{ Session::get('error') }}</div>
        @endif

        <form class="flex flex-col mb-5" action="{{ route('admin.processLogin') }}" method="post">
            @csrf
            <label for="email" class="mt-4">Email</label>
            <input class="p-4 invalid border mt-2 bg-slate-50 rounded-xl @error('email')  border-red-500 @enderror"
                type="email" name="email" value="{{ old('email') }}" placeholder="Email">
            @error('email')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror

            <label for="password" class="mt-4">Password</label>
            <input class="p-4 border mt-2 bg-slate-50 rounded-xl @error('password')  border-red-500 @enderror"
                type="password" name="password" placeholder="Password">
            @error('password')
                <p class="text-red-500 mt-1">{{ $message }}</p>
            @enderror

            <input class="p-4 mt-4 bg-teal-500 text-white font-bold rounded-lg" type="submit" value="Login">
        </form>
    </div>

    <script>
        var successMessage = document.getElementById('success_message');
        var errorMessage = document.getElementById('error_message');

        setTimeout(() => {
            successMessage.style.display = "none";
            errorMessage.style.display = "none";
        }, 5000);
    </script>
</body>

</html>
