<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Turma;
use App\Models\Pessoa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Database\Eloquent\Collection;

class PessoaController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['create', 'store']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // if (Auth::user()->tipo_id == 1) {
        //   return redirect("/");
        // }
        return view('aluno.index', ['alunos' => Pessoa::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('aluno.create', ['turmas' => Turma::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User;
        $user->name = $request->nome;
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->tipo_id = $request->tipo_id;

        $user->save();

        $aluno = new Pessoa;
        $aluno->nome = $request->nome;
        $aluno->rg = $request->rg;
        $aluno->cpf = $request->cpf;
        $aluno->sexo = $request->sexo;
        $aluno->telefone = $request->telefone;
        $aluno->matricula = $request->matricula;
        $aluno->dataNascimento = $request->dataNascimento;
        $aluno->estadoCivil = $request->estadoCivil;
        $aluno->raca = $request->raca;
        $aluno->renda = $request->renda;
        $aluno->vinculo = 1;
        $aluno->turma_id = $request->turma_id;
        $aluno->user_id = $user->id;

        $aluno->save();

        if (Auth::check()) {
          return Redirect::route('aluno.index');
        } else {
          if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            return Redirect::route('home');
          }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        return view('aluno.show', ['aluno' => Pessoa::findOrFail($id)]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        return view('aluno.edit', ['aluno' => Pessoa::findOrFail($id)], ['turmas' => Turma::all()]);
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
        $aluno = Pessoa::findOrFail($id);
        $user = User::findOrFail($aluno->user_id);

        if (Hash::check($request->old_password, $user->password)) {

          $user->name = $request->nome;
          $user->email = $request->email;
          $user->password = bcrypt($request->password);
          $user->tipo_id = $request->tipo_id;

          $user->save();

          $aluno->nome = $request->nome;
          $aluno->rg = $request->rg;
          $aluno->cpf = $request->cpf;
          $aluno->sexo = $request->sexo;
          $aluno->telefone = $request->telefone;
          $aluno->matricula = $request->matricula;
          $aluno->dataNascimento = $request->dataNascimento;
          $aluno->estadoCivil = $request->estadoCivil;
          $aluno->raca = $request->raca;
          $aluno->renda = $request->renda;
          $aluno->vinculo = $request->vinculo;
          $aluno->turma_id = $request->turma_id;
          $aluno->user_id = $user->id;

          $aluno->save();

        }

        return Redirect::route('aluno.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        $aluno = Pessoa::findOrFail($id);
        $user = User::findOrFail($aluno->user_id);
        $aluno->delete();
        $user->delete();

        return Redirect::route('aluno.index');
    }

    public function perfil()
    {
        return view('aluno.perfil', ['aluno' => Pessoa::where('user_id', Auth::user()->id)->first()]);
    }

}
