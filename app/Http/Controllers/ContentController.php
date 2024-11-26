<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Content;
use App\Models\User;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->input('search');
        $dataSearched = Content::query()
            ->when($search, function ($query, $search) {
                return $query->where('judul', 'LIKE', "%{$search}%")
                             ->orWhere('tenggat', 'LIKE', "%{$search}%")
                             ->orWhere('status', 'LIKE', "%{$search}%")
                             ->orWhere('creator', 'LIKE', "%{$search}%");
            })
            ->paginate(5);
        $data = Content::with('user')->paginate(5);

        return view('dashboard', compact('dataSearched', 'search', 'data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = User::all();
        return view('create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = [
            'judul' => $request->judul,
            'tenggat' => $request->tenggat,
            'status' => 'belum',
            'creator' => $request->creator,
        ];

        Content::create($data);
        return redirect()->route('content.create')->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function status(Request $request, string $id)
    {
        $data = [
            'status' => $request->status,
        ];

        Content::findOrFail($id)->update($data);
        return redirect()->route('content.index')->with('success', 'Status berhasil diupdate!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $creator = User::all();
        $data = Content::with('user')->findOrFail($id);
        return view('edit', compact('data', 'creator'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = [
            'judul' => $request->judul,
            'tenggat' => $request->tenggat,
            'creator' => $request->creator,
        ];

        Content::findOrFail($id)->update($data);
        return redirect()->route('content.index')->with('success', 'Data berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Content::findOrFail($id)->delete();
        return redirect()->route('content.index')->with('success', 'Data berhasil dihapus!');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Logs the user out

        // Invalidate the session and regenerate the CSRF token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Redirect to the homepage
        return redirect()->route('login');
    }
}
