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


    public function getItemsFromPedido($id)
    {
        try {
            $pedido = Pedido::findOrFail($id);
            if ($pedido) {
                $itens = $pedido->itensPedidos;
                return response()->json($itens, 200);
            }
            return response()->json(['error' => 'Pedido não encontrado'], 404);
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
            $data = $request->pedido;
            $itens = $request->itens;
            $pedido = Pedido::findOrFail($id);
            $pedido->fill($data);
            $pedido->Forma_pagamento = $pedido->formasdePagamento[$pedido->Forma_pagamento];
            $pedido->save();
            $pedido = $pedido->fresh();
            $pedido->itensPedidos()->delete();
            foreach ($itens as $item) {
                $item['idPedido'] = $pedido->idPedido;
                $pedido->itensPedidos()->create($item);
            }
            return response()->json($pedido, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->pedido;

            $itens = $request->itens;
            $pedido = new Pedido();
            $pedido->fill($data);
            $pedido->Forma_pagamento = $pedido->formasdePagamento[$pedido->Forma_pagamento];
            $pedido->save();
            $pedido = $pedido->fresh();

            foreach ($itens as $item) {
                $item['idPedido'] = $pedido->idPedido;
                $pedido->itensPedidos()->create($item);
            }
            return response()->json($pedido, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pedido = Pedido::find($id);
            if ($pedido) {
                $pedido->delete();
                return response()->json(['data' => 'Pedido removido com sucesso'], 200);
            }
            return response()->json(['error' => 'Pedido não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
