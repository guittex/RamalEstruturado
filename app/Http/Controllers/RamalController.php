<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;

use Illuminate\Support\Facades\Validator;



class RamalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $registro = \App\Ramal::orderby('nome')->paginate(20);

        return view('ramal.index' , compact('registro'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Pego todos inputs exceto o token
        $inputs = $request->except('_token');

        //Crio um array de validação de campo
        $validateArray = array(
            "nome" => "required|max:100",
            "departamento" => "required|max:40",
            "ramal" => "required|integer",
            "email" => "email|max:71",
        );

        //Executo a validação
        $validate = Validator::make($inputs, $validateArray);

        //Verifico se falhou
        if($validate->fails()){
            //Pego o array da mensagem de erro
            $array = $validate->errors()->messages();

            //Percorro o array de erro
            foreach($array as $errors){
                //Pego a mensagem de erro
                $errors = $errors[0];

                //Gravo uma seção com a mensagem de erro
                \Session::flash('flash_message',[
                    "msg" => "$errors",
                    "class" => "alert-danger"
                ]);

                //Volto para rota
                return redirect()->route('ramal');
            }

        }else{
            $ramal = new \App\Ramal;
            $ramal->nome = $request->nome;
            $ramal->departamento = $request->departamento;
            $ramal->ramal = $request->ramal;
            $ramal->email = $request->email;
            $ramal->corporativo = $request->corporativo;

            $save = $ramal->save();
            
            if($save == true){
                //Gravo uma seção com a mensagem de ok
                \Session::flash('flash_message',[
                    "msg" => "Ramal criado com sucesso",
                    "class" => "alert-success"
                ]);

                //Volto para rota
                return redirect()->route('ramal');
            }else{
                //Gravo uma seção com a mensagem de problema
                \Session::flash('flash_message',[
                    "msg" => "Não foi possível salvar o ramal, entre em contato com a TI",
                    "class" => "alert-danger"
                ]);

                //Volto para rota
                return redirect()->route('ramal');
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $token = $request->_token;

        if($token == null){
            \Session::flash('flash_message',[ 
                "msg" => "NÃO É POSSÍVEL PESQUISAR SEM UM PARÂMETRO",
                "class" => "alert-danger"
            ]);

            return redirect()->route('ramal');
            
        }else{
            $inputs = array(
                "nome" => $request->nome,
                "departamento" => $request->departamento
            );

            $validate = array_search(!null, $inputs);

            if($validate == false){
                \Session::flash('flash_message', [
                    "msg" => "Necessário digitar algo na pesquisa",
                    "class" => "alert-danger"
                ]);

                return redirect()->route('ramal');

            }

            if($validate == "nome"){
                $registro = \App\Ramal::where("nome", "like", "%$request->nome%")->paginate(100);

                return view("ramal.index", compact("registro"));
            }

            if($validate == "departamento"){
                $registro = \App\Ramal::where("departamento", "like", "$request->departamento%")->paginate(100);

                return view("ramal.index", compact("registro"));
            }

        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        $registro = \App\Ramal::find($request->id);

        if($registro == null){
            \Session::flash('flash_message',[
                "msg" => "Registro não encontrado",
                "class" => "alert-danger"
            ]);

            return redirect()->route("ramal");
        }else{
            $registro->nome = $request->nome;
            $registro->departamento = $request->departamento;
            $registro->ramal = $request->ramal;
            $registro->email = $request->email;
            $registro->corporativo = $request->corporativo;

            $save = $registro->save();

            if($save == true){
                //Gravo uma seção com a mensagem de ok
                \Session::flash('flash_message',[
                    "msg" => "Ramal editado com sucesso",
                    "class" => "alert-success"
                ]);

                //Volto para rota
                return redirect()->route('ramal');
            }else{
                //Gravo uma seção com a mensagem de problema
                \Session::flash('flash_message',[
                    "msg" => "Não foi possível alterar o ramal, entre em contato com a TI",
                    "class" => "alert-danger"
                ]);

                //Volto para rota
                return redirect()->route('ramal');
            }

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $registro = \App\Ramal::find($id);

        if($registro == null){
            \Session::flash('flash_message',[
                "msg" => "Registro não encontrado",
                "class" => "alert-danger"
            ]);

            return redirect()->route("ramal");
        }else{
            $registro->delete();

            \Session::flash('flash_message',[
                "msg" => "Deletado com sucesso",
                "class" => "alert-success"
            ]);

            return redirect()->route("ramal");
        }
    }
}
