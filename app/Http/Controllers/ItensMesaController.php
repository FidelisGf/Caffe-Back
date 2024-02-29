<?php

namespace App\Http\Controllers;

use App\ItensMesa;
use Illuminate\Http\Request;

class ItensMesaController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/itens-mesa",
     *     summary="Listar itens da mesa",
     *     tags={"Itens da Mesa"},
     *     @OA\Parameter(
     *         name="idMesa",
     *         in="query",
     *         description="ID da mesa",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna a lista de itens da mesa"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Post(
     *     path="/api/itens-mesa",
     *     summary="Adicionar item à mesa",
     *     tags={"Itens da Mesa"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do novo item da mesa",
     *         @OA\JsonContent(
     *             required={"idMesa", "Quantidade", "Total_soma", "idProduto"},
     *             @OA\Property(property="idMesa", type="integer"),
     *             @OA\Property(property="Quantidade", type="integer"),
     *             @OA\Property(property="Total_soma", type="number", format="double"),
     *             @OA\Property(property="idProduto", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Item da mesa adicionado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Erros de validação"
     *     )
     * ),
     * @OA\Put(
     *     path="/api/itens-mesa/{id}",
     *     summary="Atualizar item da mesa",
     *     tags={"Itens da Mesa"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do item da mesa a ser atualizado",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do item da mesa a serem atualizadas",
     *         @OA\JsonContent(
     *             @OA\Property(property="idMesa", type="integer"),
     *             @OA\Property(property="Quantidade", type="integer"),
     *             @OA\Property(property="Total_soma", type="number", format="double"),
     *             @OA\Property(property="idProduto", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Item da mesa atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Item da mesa não encontrado"
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
            $itensMesa = ItensMesa::where('idMesa', $request->idMesa)
                ->get()
                ->toArray();
            return response()->json($itensMesa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function store(Request $request)
    {
        try {
            $idMesa = $request->idMesa;
            $itensMesa = $request->itensMesa;
            foreach ($itensMesa as $item) {
                $itensMesa = new ItensMesa();
                $itensMesa->idMesa = $idMesa;
                $itensMesa->Quantidade = $item['quantidade'];
                $itensMesa->Total_soma = $item['total_soma'];
                $itensMesa->idProduto = $item['idProduto'];
                $itensMesa->save();
            }
            return response()->json($itensMesa, 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $itensMesa = ItensMesa::findOrFail($id);
            $itensMesa->fill($request->all());
            $itensMesa->save();
            return response()->json($itensMesa, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }




}
