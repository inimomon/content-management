@php
  $no = 1;    
@endphp

@extends('layouts.template')

@section('content')
    <div class="flex justify-between items-center">
        <h1 class="font-semibold">Selamat Datang, {{ Auth::user()->name }}</h1>
        <form action="{{ route('content.index') }}" method="GET" class="p-2 rounded-md border border-black">
          <input 
              type="text" 
              name="search" 
              class="form-control me-2" 
              placeholder="Search posts..." 
              value="{{ request('search') }}">
          <button type="submit" class="btn btn-primary">Search</button>
        </form>
    </div>
    <table class="mt-4 min-w-full border-collapse border border-gray-200">
        <thead class="bg-gray-100">
          <tr>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">#</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">Judul</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">Tengat</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">Status</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">Kreator</th>
            <th class="px-6 py-3 text-left text-sm font-semibold text-gray-600 border-b">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @if ($dataSearched)
          @foreach ($dataSearched as $d)
          <tr class="{{$no % 2 == 1 ? 'bg-gray-50' : 'bg-gray-100'}}">
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$no++}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->judul}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->tenggat}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">
              <form action="{{ route('content.status', $d->id_content) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <select class="p-1 px-2 rounded-lg border border-blue-400" name="status" onchange="this.form.submit()">
                      <option class="" value="selesai" {{ $d->status == 'selesai' ? 'selected' : '' }}>selesai</option>
                      <option value="belum" {{ $d->status == 'belum' ? 'selected' : '' }}>belum</option>
                  </select>
              </form>           
            </td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->user->name}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b flex gap-2">
              <a href="{{route('content.edit', $d->id_content)}}" class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                <form action="{{ route('content.destroy', $d->id_content) }}" method="POST" onsubmit="return confirm('Apakah kamu ingin menghapus data ini?');">
                  @csrf
                  @method('DELETE') <!-- This tells Laravel it's a DELETE request -->
                  <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                </form>
            </td>
          </tr>
          @endforeach
          @else
          @foreach ($data as $d)
          <tr class="{{$no % 2 == 1 ? 'bg-gray-50' : 'bg-gray-100'}}">
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$no++}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->judul}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->tenggat}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">
              <form action="{{ route('content.status', $d->id_content) }}" method="POST">
                  @csrf
                  @method('PUT')
                  <select class="p-1 px-2 rounded-lg border border-blue-400" name="status" onchange="this.form.submit()">
                      <option class="" value="selesai" {{ $d->status == 'selesai' ? 'selected' : '' }}>selesai</option>
                      <option value="belum" {{ $d->status == 'belum' ? 'selected' : '' }}>belum</option>
                  </select>
              </form>           
            </td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b">{{$d->user->name}}</td>
            <td class="px-6 py-4 text-sm text-gray-800 border-b flex gap-2">
              <a href="{{route('content.edit', $d->id_content)}}" class="px-3 py-1 text-white bg-blue-500 rounded hover:bg-blue-600">Edit</a>
                <form action="{{ route('content.destroy', $d->id_content) }}" method="POST" onsubmit="return confirm('Apakah kamu ingin menghapus data ini?');">
                  @csrf
                  @method('DELETE') <!-- This tells Laravel it's a DELETE request -->
                  <button type="submit" class="px-3 py-1 text-white bg-red-500 rounded hover:bg-red-600">Hapus</button>
                </form>
            </td>
          </tr>
          @endforeach
          @endif
        </tbody>
      </table>
      <div class="mt-4">
        {{ $data->links() }}
      </div>
@endsection