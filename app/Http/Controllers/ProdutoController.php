<?php

namespace App\Http\Controllers;

use App\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    /**
     * @OA\Post(
     *     path="/api/produto",
     *     summary="Register product",
     *     @OA\Parameter(
     *         name="Nome_produto",
     *         in="query",
     *         description="Nome_produto",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Parameter(
     *         name="Preco_compra",
     *         in="query",
     *         description="preco compra",
     *         required=true,
     *         @OA\Schema(type="double")
     *     ),
     *     @OA\Parameter(
     *         name="Preco_venda",
     *         in="query",
     *         description="preco venda",
     *         required=true,
     *         @OA\Schema(type="double")
     *     ),
     *      @OA\Parameter(
     *         name="Descricao",
     *         in="query",
     *         description="Descrição",
     *         required=true,
     *         @OA\Schema(type="string ")
     *     ),
     *     @OA\Response(response="201", description="Produto criado"),
     *     @OA\Response(response="422", description="Validation errors")
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

            $produto = Produto::find($id);
            if ($produto) {
                $produto->fill($data);
                $produto->save();

                return response()->json(['data' => $produto], 200);
            }
            return response()->json(['error' => 'Produto não encontrado'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
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
}
