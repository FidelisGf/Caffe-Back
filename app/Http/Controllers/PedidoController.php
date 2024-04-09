<?php

namespace App\Http\Controllers;

use App\Estoque;
use App\Pedido;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
            DB::beginTransaction();
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
                try {
                    $estoque = Estoque::where('idProduto', $item['idProduto'])
                        ->orderBy('data', 'desc')
                        ->firstOrFail();
                    $estoque->quantidade -= $item['Quantidade'];
                    $estoque->data = $pedido->Data;
                    $estoque->save();
                } catch (\Exception $e) {
                    throw new \Exception('Produto não encontrado no estoque', 404);
                }
            }
            DB::commit();
            return response()->json($pedido, 201);
        } catch (\Exception $e) {
            DB::rollBack();
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

    public function getRelatorioDePedidos(Request $request)
    {
        $initDate = Carbon::parse($request->input('initDate'))->format('Y-m-d');
        $endDate = Carbon::parse($request->input('endDate'))->format('Y-m-d');
        $filterByFormaPagamento = $request->input('filterByFormaPagamento');
        $pedidosOrderByData = Pedido::whereBetween('Data', [$initDate, $endDate])
            ->orderBy('Data', 'asc')
            ->selectRaw("Data, SUM(Valor_total) as Valor_total, COUNT(idPedido) as Quantidade_pedidos, Forma_pagamento")
            ->groupByRaw("Data, Forma_pagamento")
            ->get();
        return response()->json($pedidosOrderByData, 200);
    }
}
