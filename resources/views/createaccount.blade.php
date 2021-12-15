@extends('app')
@section('content')
    <form>
        <div class="mb-4">
            <label class="block text-md font-light mb-2" for="username">Username</label>
            <input class="w-full bg-drabya-gray border-gray-500 appearance-none border p-4 font-light leading-tight focus:outline-none focus:shadow-outline" type="text" name="username" id="" placeholder="Username">
        </div>
        <div class="mb-4">
            <label class="block text-md font-light mb-2" for="password">Password</label>
            <input class="w-full bg-drabya-gray border-gray-500 appearance-none border p-4 font-light leading-tight focus:outline-none focus:shadow-outline" type="password" name="password" id="" placeholder="Password">
        </div>

        <div class="flex items-center justify-between mb-5">
            <button class="bg-indigo-600 hover:bg-blue-700 text-white font-light py-2 px-6 rounded focus:outline-none focus:shadow-outline" type="button">
                Creer
            </button>

        </div>
    </form>
@endsection