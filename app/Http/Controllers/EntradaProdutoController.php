<?php

namespace App\Http\Controllers;

use App\EntradaProduto;
use Illuminate\Http\Request;

class EntradaProdutoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/entrada-produto",
     *     summary="Listar entradas de produtos",
     *     tags={"Entrada de Produto"},
     *     @OA\Parameter(
     *         name="idProduto",
     *         in="query",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna a lista de entradas de produtos"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao buscar entrada de produtos"
     *     )
     * )
     * @OA\Post(
     *     path="/api/entrada-produto",
     *     summary="Registrar entrada de produto",
     *     tags={"Entrada de Produto"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações da entrada de produto",
     *         @OA\JsonContent(
     *             required={"idProduto", "Quantidade", "Preco", "Data", "Validade", "Informacoes_adicionais"},
     *             @OA\Property(property="idProduto", type="integer"),
     *             @OA\Property(property="Quantidade", type="integer"),
     *             @OA\Property(property="Preco", type="number", format="double"),
     *             @OA\Property(property="Data", type="string", format="date"),
     *             @OA\Property(property="Validade", type="string", format="date"),
     *             @OA\Property(property="Informacoes_adicionais", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Entrada de produto cadastrada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao cadastrar entrada de produto"
     *     )
     * )
     * @OA\Get(
     *     path="/api/entrada-produto/{id}",
     *     summary="Mostrar detalhes da entrada de produto",
     *     tags={"Entrada de Produto"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da entrada de produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna os detalhes da entrada de produto"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao buscar entrada de produto"
     *     )
     * )
       * @OA\Put(
     *     path="/api/entrada-produto/{id}",
     *     summary="Atualizar entrada de produto",
     *     tags={"Entrada de Produto"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID da entrada de produto a ser atualizada",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações da entrada de produto a serem atualizadas",
     *         @OA\JsonContent(
     *             @OA\Property(property="idProduto", type="integer"),
     *             @OA\Property(property="Quantidade", type="integer"),
     *             @OA\Property(property="Preco", type="number", format="double"),
     *             @OA\Property(property="Data", type="string", format="date"),
     *             @OA\Property(property="Validade", type="string", format="date"),
     *             @OA\Property(property="Informacoes_adicionais", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Entrada de produto atualizada com sucesso"
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="Erro ao atualizar entrada de produto"
     *     )
     * )
     
     */






    public function index(Request $request)
    {
        try {
            $idProduto = $request->idProduto;
            $entradaProduto = EntradaProduto::where('idProduto', $idProduto)->get();
            return response()->json($entradaProduto, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar entrada de produtos', 'error' => $e], 400);
        }
    }


    public function store(Request $request)
    {
        try {
            $entradaProduto = new EntradaProduto();
            $entradaProduto->idProduto = $request->idProduto;
            $entradaProduto->Quantidade = $request->Quantidade;
            $entradaProduto->Preco = $request->Preco;
            $entradaProduto->Data = $request->Data;
            $entradaProduto->Validade = $request->Validade;
            $entradaProduto->Informacoes_adicionais = $request->Informacoes_adicionais;
            $entradaProduto->save();
            return response()->json(['message' => 'Entrada de produto cadastrada com sucesso'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao cadastrar entrada de produto', 'error' => $e], 400);
        }
    }

    /**
     
     */



    public function show($id)
    {
        try {
            $entradaProduto = EntradaProduto::findOrFail($id);
            return response()->json($entradaProduto, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao buscar entrada de produto', 'error' => $e], 400);
        }
    }

    /**
     
     */



    public function update(Request $request, $id)
    {
        try {
            $entradaProduto = EntradaProduto::findOrFail($id);
            $entradaProduto->fill($request->all());
            $entradaProduto->save();
            return response()->json($entradaProduto, 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Erro ao atualizar entrada de produto', 'error' => $e], 400);
        }
    }

    /**
   
     */




}
