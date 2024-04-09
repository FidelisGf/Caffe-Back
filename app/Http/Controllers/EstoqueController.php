<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Produto;
use Illuminate\Http\Request;

class EstoqueController extends Controller
{
    public function index(Request $request)
    {
        try {
            $estoque = Produto::paginate(40)->toArray();
            $data = $estoque['data'];
            foreach ($data as $item => $value) {
                $estoque = Estoque::where('idProduto', $value['idProduto'])->orderBy('created_at', 'desc')->first();
                $data[$item]['data'] = date('d/m/Y', strtotime($estoque->data ?? now()));
                $data[$item]['estoque'] = $estoque->quantidade ?? 0;
            }
            $estoque['data'] = $data;
            return response()->json($estoque, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $estoque = Estoque::findOrFail($id)->orderBy('created_at', 'desc')->first();
            $estoque['produto'] = Produto::findOrFail($estoque->idProduto)->Nome_produto;
            $estoque['data'] = date('d/m/Y', strtotime($estoque->data));
            return response()->json($estoque, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
