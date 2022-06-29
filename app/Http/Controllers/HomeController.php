<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Imovel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $user = Auth::user();
      //  dd($user);
        //echo (Auth::user()->permissions);
        if ($user->perfil ==  3) {
            $clientes = Client::where('usuario', Auth::user()->id)->get(); //Negócios
            $array = [];

            foreach ($clientes as $cliente) {
                array_push($array, $cliente->id);
            }

            $imoveis=Imovel::whereIn('client_id', $array)->get();

            $gestor = false;
            return view('home', compact('imoveis', 'gestor'));
        } else {
            $imoveis = Imovel::all();

            $gestor = true;
            return view('home', compact('imoveis', 'gestor'));
        }
        //dd($cliente);

    }
}
