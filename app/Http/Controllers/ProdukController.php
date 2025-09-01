<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        return view('produk.index');
    }

    public function create()
    {
        return view('produk.tambah');
    }

    public function store(Request $request)
    {
        //
    }

    // public function show(string $id)
    public function show()
    {
        return view('produk.detail');
    }

    // public function edit(string $id)
    public function edit()
    {
        return view('produk.edit');
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
