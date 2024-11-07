<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Content;
use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;


class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contents = Content::with(['likes', 'user', 'comments'])->where('id_users', Auth::id())->latest()->get();;
        return view('login', compact('contents'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('login.create'); //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'tanggal' => 'nullable|date',
            'judul' => 'required',
            'deskripsi' => 'required',
            'id_users' => 'nullable',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/contents', $image->hashName());

        Content::create([
            'image' => $image->hashName(),
            'tanggal' => $request->tanggal ?? now(),
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi ?? '',
            'id_users' => Auth::id(),
        ]);

        return redirect()->route('profil.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $content = Content::findOrFail($id);
        return view('edit', compact('content'));
    }

    public function update(Request $request, $id)
{

    // Pengecekan validasi
    $request->validate([
        'judul' => 'required|string',
        'deskripsi' => 'required|string',
    ]);

    $content = Content::findOrFail($id);

    // Update data jika validasi berhasil

    $content->update([
        'judul'=> $request->judul,
        'deskripsi'=> $request->deskripsi,
    ]);

    return redirect()->route('profil.index')->with('success', 'Konten berhasil diupdate');

}



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
{
    // Debug: Check if the user is authenticated
    if (!auth()->check()) {
        return redirect()->route('login')->with('error', 'Please log in to delete content.');
    }

    // Fetch and delete the content
    $content = Content::findOrFail($id);
    $content->delete();

    return redirect()->back()->with('success', 'Content deleted successfully.');
}


    public function like($contentId)
{
    $user = Auth::user(); // Ambil pengguna yang sedang login

    // Cek apakah pengguna sudah menyukai konten ini
    $hasLiked = Like::where('id_contents', $contentId)
        ->where('id_users', $user->id)
        ->exists();

    if ($hasLiked) {
        // Jika sudah, hapus like
        $like = Like::where('id_contents', $contentId)
            ->where('id_users', $user->id)
            ->first();
        if ($like) {
            $like->delete();
            return redirect()->route('konten.index')->with('success', 'Di dislike Berhasil');
        }
    } else {
        // Jika belum, buat like baru
        Like::create([
            'id_contents' => $contentId,
            'id_users' => $user->id,
            'tanggal' => now(),
        ]);
        return redirect()->route('konten.index')->with('success', 'Like Berhasil');
    }
}


public function comment(Request $request, $contentId)
{
    $request->validate([
        'komentar' => 'required|string',
    ]);

    Comment::create([
        'komentar' => $request->komentar,
        'tanggal' => now(),
        'id_contents' => $contentId,
        'id_users' => Auth::id(),
    ]);

    return redirect()->back()->with('success', 'Komentar berhasil ditambahkan!');
}


}
