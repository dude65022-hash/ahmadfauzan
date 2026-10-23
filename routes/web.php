<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

// Halaman utama — pakai view welcome sebagai home
Route::get('/', function () {
    $articles = DB::table('article')->get();
    return view('welcome', ['articles' => $articles]);
});

Route::get('/porto', function () {
    return view('porto');
});

Route::get('/biodata', function () {
    return view('article');
});

// Admin dashboard
Route::get('/admin', function () {
    return view('admin.index');
})->name('admin');

// CRUD Artikel
Route::get('/admin/artikel', function () {
    $articles = DB::table('article')->get();
    return view('admin.artikel', ['articles' => $articles]);
})->name('admin.artikel.index');

Route::get('/admin/artikel/tambah', function () {
    return view('admin.tambah_artikel');
})->name('admin.artikel.tambah');

Route::post('/admin/artikel', function (\Illuminate\Http\Request $request) {
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi'   => 'required|string',
    ]);
    DB::table('article')->insert([
        'judul'         => $request->judul,
        'isi'           => $request->isi,
        'tanggalterbit' => now()->toDateString(),
        'created_at'    => now(),
        'updated_at'    => now(),
    ]);
    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil ditambahkan.');
})->name('admin.artikel.store');

Route::get('/admin/artikel/{id}/edit', function ($id) {
    $art = DB::table('article')->where('id', $id)->first();
    abort_if(!$art, 404);
    return view('admin.edit_artikel', ['art' => $art]);
})->name('admin.artikel.edit');

Route::put('/admin/artikel/{id}', function (\Illuminate\Http\Request $request, $id) {
    $request->validate([
        'judul' => 'required|string|max:255',
        'isi'   => 'required|string',
    ]);
    DB::table('article')->where('id', $id)->update([
        'judul'      => $request->judul,
        'isi'        => $request->isi,
        'updated_at' => now(),
    ]);
    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil diupdate.');
})->name('admin.artikel.update');

Route::delete('/admin/artikel/{id}', function ($id) {
    DB::table('article')->where('id', $id)->delete();
    return redirect()->route('admin.artikel.index')->with('success', 'Artikel berhasil dihapus.');
})->name('admin.artikel.destroy');
