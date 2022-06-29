<?php

namespace App\Http\Middleware;

use App\Models\Client;
use App\Models\DocumentImovel;
use App\Models\Imovel;
use Closure;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CheckImovel
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        //echo($request->id);
        $client = Client::where('usuario', Auth::user()->id)->first();
      //  dd($client);

        if($client != null)
        $imovel = Imovel::where('client_id', $client->id)->where('id', $request->id)->first();

        //dd($imovel);

        $doc = DocumentImovel::where('imovel_id', $request->id)->first();
        $item = DocumentImovel::where('id', $request->idDocumento)->first();

        if (Auth::user()->hasRole('admin') || $imovel || $doc || $item) {
            return $next($request);
        } else {
            return abort(403, "Não é possível acessar essa página - MIDDLEWARE");
        }
        return $next($request);
    }
}
