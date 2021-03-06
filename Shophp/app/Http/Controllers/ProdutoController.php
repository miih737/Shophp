<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\ModelProduto;

class ProdutoController extends Controller
{
    private $objProduto;

    public function __construct(){
        $this->objProduto=new ModelProduto();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("main_views/list", [
            'type' => 'produto',
            'pagename' => 'Listar Produtos',
            'objects' => $this->objProduto->all(),
            'attributes' => ['nome','preco','descricao'],
            'labels' => ['Nome', 'Preço', 'Descrição']
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loadform() {
        return view("main_views/insert", [
            'pagename' => 'Inserir Produto',

            'fields' => [
                'nome' => [
                    'element' => 'input',
                    'type' => 'text'
                ],
                'preco' => [
                    'element' => 'input',
                    'type' => 'number'
                ],
                'descricao' => [
                    'element' => 'input',
                    'type' => 'text'
                ]
            ],

            'attributes' => ['nome', 'preco', 'descricao'],
            'labels' => ['Nome', 'Preço', 'Descrição'],
            'method' => 'POST',
            'action' => '/produto/inserir/action/'
        ]);
    }
    
    public function store(Request $request)
    {
        $cad = $this->objProduto->create([
            'nome'=>$request->nome,
            'preco'=>$request->preco,
            'descricao'=>$request->descricao
            ]);
            if($cad)
                return redirect("/produtos");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produto = $this->objProduto->find($id);
        return view("");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function loadformupdate($id) {
        return view("main_views/insert", [
            'pagename' => 'Editar Produto',

            'fields' => [
                'nome' => [
                    'element' => 'input',
                    'type' => 'text'
                ],
                'preco' => [
                    'element' => 'input',
                    'type' => 'number'
                ],
                'descricao' => [
                    'element' => 'input',
                    'type' => 'text'
                ]
            ],

            'attributes' => ['nome', 'preco', 'descricao'],
            'labels' => ['Nome', 'Preço', 'Descrição'],
            'method' => 'POST',
            'action' => '/produto/editar/action/' . $id
        ]);
    }

    public function update(Request $request, $id)
    {
        $this->objProduto->where(['id'=>$id])->update([
            'nome'=>$request->nome,
            'preco'=>$request->preco,
            'descricao'=>$request->descricao
        ]);

        return redirect("/produtos");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $del = $this->objProduto->destroy($id);
        return($del)?"sim":"não";
    }

}
