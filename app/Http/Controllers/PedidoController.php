<?php

namespace App\Http\Controllers;

use App\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    public function index(Request $request)
    {
        try {
            $current_page = $request->input('page', 1);
            $pedidos = Pedido::paginate(40, ['*'], 'page', $current_page)
                ->toArray();
            return response()->json($pedidos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show($id)
    {
        try {
            $pedido = Pedido::find($id);
            if ($pedido) {
                return response()->json($pedido, 200);
            }
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $pedido = Pedido::findOrFail($id);
            $pedido->fill($data);
            $pedido->save();
            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $pedido = new Pedido();
            $pedido->fill($data);
            $pedido->save();
            return response()->json($pedido, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
