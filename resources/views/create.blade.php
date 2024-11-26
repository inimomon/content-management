@extends('layouts.template')

@section('content')
<form action="{{route('content.store')}}" method="POST">
    @csrf
    @method('POST')
    <!-- Name -->
    <div class="mb-2">
      <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Judul</label>
      <input
        type="text" 
        id="name" 
        name="judul" 
        placeholder="Tuliskan judul jadwal"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
      />
    </div>

    <!-- Email -->
    <div class="mb-2">
      <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Tenggat</label>
      <input 
        type="date" 
        id="email" 
        name="tenggat" 
        placeholder="Enter your email"
        class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
      />
    </div>

    <!-- Password -->
    <div class="mb-2">
        <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Kreator</label>
        <select 
          type="password" 
          id="password" 
          name="creator" 
          placeholder="Enter your password"
          class="w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500"
        >
        @foreach ($data as $d)
        <option value="{{$d->id}}">{{$d->name}}</option>
        @endforeach
        </select>
    </div>

    <!-- Submit Button -->
    <div class="mt-6">
      <button 
        type="submit" 
        class="w-full px-4 py-2 bg-blue-500 text-white font-semibold rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
      >
        Tambah
      </button>
    </div>
    @if (session('status'))
      <div class="text-green-500 mt-2 text-center">
        {{ session('status') }}
      </div>
    @endif
  </form>
@endsection