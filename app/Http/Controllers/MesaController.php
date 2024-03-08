<?php

namespace App\Http\Controllers;

use App\Mesa;
use Illuminate\Http\Request;
use App\ItensMesa;

class MesaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/mesas",
     *     summary="Listar mesas",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número da página (opcional)",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna a lista de mesas"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Get(
     *     path="/api/mesas/{id}",
     *     summary="Mostrar detalhes da mesa",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da mesa",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna os detalhes da mesa"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa não encontrada"
     *     )
     * ),
     * @OA\Post(
     *     path="/api/mesas",
     *     summary="Adicionar mesa",
     *     tags={"Mesas"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações da nova mesa",
     *         @OA\JsonContent(
     *             required={"Status_mesa", "Preco_total", "Numero_mesa", "Tipo_pagamento"},
     *             @OA\Property(property="Status_mesa", type="boolean"),
     *             @OA\Property(property="Preco_total", type="number", format="double"),
     *             @OA\Property(property="Numero_mesa", type="integer"),
     *             @OA\Property(property="Tipo_pagamento", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Mesa adicionada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Put(
     *     path="/api/mesas/{id}",
     *     summary="Atualizar mesa",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da mesa a ser atualizada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações da mesa a serem atualizadas",
     *         @OA\JsonContent(
     *             @OA\Property(property="Status_mesa", type="boolean"),
     *             @OA\Property(property="Preco_total", type="number", format="double"),
     *             @OA\Property(property="Numero_mesa", type="integer"),
     *             @OA\Property(property="Tipo_pagamento", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mesa atualizada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa não encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Put(
     *     path="/api/mesas/{id}/abrir-fechar",
     *     summary="Abrir ou fechar mesa",
     *     tags={"Mesas"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da mesa a ser aberta ou fechada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Status da mesa",
     *         @OA\JsonContent(
     *             @OA\Property(property="Status_mesa", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Status da mesa atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Mesa não encontrada"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * )
     */






    public function index(Request $request)
    {
        try {
            $current_page = $request->input('page', 1);
            $mesas = Mesa::paginate(40, ['*'], 'page', $current_page)
                ->toArray();
            return response()->json($mesas, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }




    public function show($id)
    {
        try {
            $mesa = Mesa::findOrFail($id);
            return response()->json($mesa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $mesa = Mesa::findOrFail($id);
            $mesa->fill($request->all());
            $mesa->save();
            return response()->json($mesa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }





    public function openCloseMesa(Request $request, $id)
    {
        try {
            $mesa = Mesa::findOrFail($id);
            $mesa->Status_mesa = $request->Status_mesa;
            $mesa->save();
            return response()->json($mesa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }





    public function store(Request $request)
    {
        try {
            $itensMesa = $request->itensMesa;
            try {
                $mesa = new Mesa();
                $mesa->fill($request->all());
                $mesa->save();
            } catch (\Exception $e) {
                return response()->json(['error' => $e->getMessage()], $e->getCode());
            }
            if ($itensMesa) {
                foreach ($itensMesa as $item) {
                    $itensMesa = new ItensMesa();
                    $itensMesa->idMesa = $item['idMesa'];
                    $itensMesa->Quantidade = $item['quantidade'];
                    $itensMesa->Total_soma = $item['total_soma'];
                    $itensMesa->idProduto = $item['idProduto'];
                    $itensMesa->save();
                }
            }
            return response()->json($mesa, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
