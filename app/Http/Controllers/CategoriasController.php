<?php

namespace App\Http\Controllers;

use App\Categorias;
use Illuminate\Http\Request;

class CategoriasController extends Controller
{


    public function index()
    {
        try {
            $categorias = Categorias::all();
            return response()->json($categorias);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $categoria = Categorias::find($id);
            if ($categoria) {
                return response()->json(['data' => $categoria], 200);
            }
            return response()->json(['error' => 'Categoria não encontrada'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $categoria = Categorias::findOrFail($id);
            $categoria->fill($data);
            $categoria->save();
            return response()->json(['data' => $categoria], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $categoria = new Categorias();
            $categoria->fill($data);
            $categoria->save();
            return response()->json(['data' => $categoria], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
