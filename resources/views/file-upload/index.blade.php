@extends('layouts.centered')
@section('content')
<div class="flex flex-col  items-center justify-center min-h-screen h-screen bg-gradient-to-b  from-green-300">
    <h1 class="mb-4 text-3xl font-extrabold text-gray-900 dark:text-white md:text-5xl lg:text-6xl">
        <span class="text-transparent bg-clip-text bg-gradient-to-r to-pink-500 from-sky-400">
        Upload
        </span>
    </h1>
    <form action="store" method="post" enctype="multipart/form-data">
        @csrf
        <input type="file" name="mFile">
     
        @error('photo') <span class="error">{{ $message }}</span> @enderror
     
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Save Photo</button>
    </form>
</div>
@stop