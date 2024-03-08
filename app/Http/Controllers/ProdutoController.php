<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    /**
     * @OA\Get(
     *     path="/api/produtos",
     *     summary="Listar produtos",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         description="Número da página (opcional)",
     *         required=false,
     *         @OA\Schema(type="integer", default=1)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna a lista de produtos"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Get(
     *     path="/api/produtos/{id}",
     *     summary="Mostrar detalhes do produto",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Retorna os detalhes do produto"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
     *     )
     * ),
     * @OA\Post(
     *     path="/api/produtos",
     *     summary="Adicionar produto",
     *     tags={"Produtos"},
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do novo produto",
     *         @OA\JsonContent(
     *             required={"Nome_produto", "Preco_compra", "Preco_venda", "Descricao"},
     *             @OA\Property(property="Nome_produto", type="string"),
     *             @OA\Property(property="Preco_compra", type="number", format="double"),
     *             @OA\Property(property="Preco_venda", type="number", format="double"),
     *             @OA\Property(property="Descricao", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Produto adicionado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erro interno do servidor"
     *     )
     * ),
     * @OA\Put(
     *     path="/api/produtos/{id}",
     *     summary="Atualizar produto",
     *     tags={"Produtos"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID do produto a ser atualizado",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Informações do produto a serem atualizadas",
     *         @OA\JsonContent(
     *             @OA\Property(property="Nome_produto", type="string"),
     *             @OA\Property(property="Preco_compra", type="number", format="double"),
     *             @OA\Property(property="Preco_venda", type="number", format="double"),
     *             @OA\Property(property="Descricao", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Produto atualizado com sucesso"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Produto não encontrado"
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
            $produtos = Produto::paginate(40, ['*'], 'page', $current_page)
                ->toArray();
            return response()->json($produtos, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }

    }

    public function show($id)
    {
        try {
            $produto = Produto::find($id);
            if ($produto) {
                return response()->json(['data' => $produto], 200);
            }
            return response()->json(['error' => 'Produto não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function update(Request $request, $id)
    {
        try {
            $data = $request->all();
            $produto = Produto::findOrFail($id);
            $produto->fill($data);
            $produto->save();
            return response()->json(['data' => $produto], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }


    public function store(Request $request)
    {
        try {
            $data = $request->all();
            $produto = new Produto();
            $produto->fill($data);
            $produto->save();
            return response()->json(['data' => $produto], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $produto = Produto::findOrFail($id);
            $produto->delete();
            return response()->json("Produto [$id] deletado!", 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], $e->getCode());
        }
    }
}
