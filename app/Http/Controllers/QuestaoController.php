<?php

namespace App\Http\Controllers;

use App\Models\Eixo;
use App\Models\Questao;
use App\Models\Alternativa;
use App\Models\Questionario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class QuestaoController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('questao.index', ['questoes' => Questao::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('questao.create', ['eixos' => Eixo::all(), 'questionarios' => Questionario::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $questao = new Questao;
        $questao->titulo = $request->titulo;
        $questao->eixo_id = $request->eixo_id;
        $questao->questionario_id = $request->questionario_id;
        $questao->save();

        $alternativa = new Alternativa;
        $alternativa->alternativa = $request->alternativa_a;
        $alternativa->letra = 'A';
        $alternativa->peso = 1;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = new Alternativa;
        $alternativa->alternativa = $request->alternativa_b;
        $alternativa->letra = 'B';
        $alternativa->peso = 2;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = new Alternativa;
        $alternativa->alternativa = $request->alternativa_c;
        $alternativa->letra = 'C';
        $alternativa->peso = 3;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = new Alternativa;
        $alternativa->alternativa = $request->alternativa_d;
        $alternativa->letra = 'D';
        $alternativa->peso = 4;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        return Redirect::route('questao.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        // return response()->json(Questao::findOrFail($id));
        return view('questao.show', ['questao' => Questao::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
      return view('questao.edit', [
        'eixos' => Eixo::all(),
        'questionarios' => Questionario::all(),
        'questao' => Questao::findOrFail($id)
      ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        $questao = Questao::findOrFail($id);
        $questao->titulo = $request->titulo;
        $questao->eixo_id = $request->eixo_id;
        $questao->questionario_id = $request->questionario_id;
        $questao->save();

        $alternativa = Alternativa::where('questao_id', $id)
                                    ->where('letra', 'A')
                                    ->first();
        $alternativa->alternativa = $request->alternativa_a;
        $alternativa->letra = 'A';
        $alternativa->peso = 1;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = Alternativa::where('questao_id', $id)
                                    ->where('letra', 'B')
                                    ->first();
        $alternativa->alternativa = $request->alternativa_b;
        $alternativa->letra = 'B';
        $alternativa->peso = 2;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = Alternativa::where('questao_id', $id)
                                    ->where('letra', 'C')
                                    ->first();
        $alternativa->alternativa = $request->alternativa_c;
        $alternativa->letra = 'C';
        $alternativa->peso = 3;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        $alternativa = Alternativa::where('questao_id', $id)
                                    ->where('letra', 'D')
                                    ->first();
        $alternativa->alternativa = $request->alternativa_d;
        $alternativa->letra = 'D';
        $alternativa->peso = 4;
        $alternativa->questao_id = $questao->id;

        $alternativa->save();

        return Redirect::route('questao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $questao = Questao::findOrFail($id);
        $alternativas = $questao->alternativas;
        foreach ($alternativas as $alternativa) {
          $alternativa->delete();
        }
        $questao->delete();

        return Redirect::route('questao.index');
    }
}