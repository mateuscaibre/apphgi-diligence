<?php

namespace App\Http\Controllers\Documentos;

use App\Http\Controllers\Controller;
use App\Mail\SendMailIteracao;
use App\Mail\SendMailIteracaoStatus;
use App\Models\Client;
use App\Models\DocumentImovel;
use App\Models\Imovel;
use App\Models\Socio;
use App\User;
use Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class DocumentosController extends Controller
{
    public function lista($idImovel)
    {

        $query = DB::table('document_imovels')
            ->join('document_types', 'document_imovels.document_type_id', '=', 'document_types.id')
            ->select('*')
            ->where('imovel_id', $idImovel);
        $documentos =   $query->addSelect('document_imovels.status_documento');
        $documentos =   $query->addSelect('document_imovels.observacao');
        $documentos =   $query->addSelect('document_imovels.id as cd')->get();

        $imovel = Imovel::find($idImovel);
        $cliente = Client::where('usuario', Auth::user()->id)->first();

        $socios = Socio::where('imovel_id', $idImovel)->get();

        if ($cliente != null) {

            $gestor = false;
            return view('clientes.imoveis.documentos', compact('imovel', 'documentos', 'gestor', 'socios'));
        } else {

            $gestor = true;
            return view('clientes.imoveis.documentos', compact('imovel', 'documentos', 'gestor', 'socios'));
        }
    }
    public function listaDocumentos($idImovel, $socio_id = null)
    {

        $query = DB::table('document_imovels')
            ->join('document_types', 'document_imovels.document_type_id', '=', 'document_types.id')
            ->select('*')
            ->where('imovel_id', $idImovel)
            ->where('socio_id', $socio_id)
            ->where('fl_ativo', 1);

        $documentos =   $query->addSelect('document_imovels.status_documento');
        $documentos =   $query->addSelect('document_imovels.observacao');
        $documentos =   $query->addSelect('document_imovels.id as cd')->get();

        $imovel = Imovel::find($idImovel);
        $cliente = Client::where('usuario', Auth::user()->id)->first();

        $socio = Socio::find($socio_id);

        if ($cliente != null) {

            $gestor = false;
        } else {

            $gestor = true;
        }

        return view('clientes.imoveis.documentos-send', compact('imovel', 'documentos', 'gestor', 'socio'));
    }
    public function listaDocumentosImovel($idImovel, $socio_id = null)
    {

        $user =  Auth()->user()->hasRole('cliente');

        $query = DB::table('document_imovels')
            ->join('document_types', 'document_imovels.document_type_id', '=', 'document_types.id')
            ->select('*')
            ->where('imovel_id', $idImovel)
            ->where('socio_id', $socio_id)
            ->where('fl_ativo', 1);

        $documentos =   $query->addSelect('document_imovels.status_documento');
        $documentos =   $query->addSelect('document_imovels.observacao');
        $documentos =   $query->addSelect('document_imovels.id as cd')->get();

        $imovel = Imovel::find($idImovel);
        $cliente = Client::where('usuario', Auth::user()->id)->first();


        $socio = Socio::find($socio_id);

        if ($cliente != null) {

            $gestor = false;
        } else {

            $gestor = true;
        }

        return view('clientes.imoveis.documentos-send', compact('imovel', 'documentos', 'gestor', 'socio'));
    }
    public function uploadItemDelete($idImovel, $idDocumento)
    {

        try {
            $doc = DocumentImovel::where('imovel_id', $idImovel)->where('document_type_id', $idDocumento)->first();

            if (Storage::exists($doc->file)) {
                Storage::delete($doc->file);
                DocumentImovel::where('imovel_id', $idImovel)->where('document_type_id', $idDocumento)->update(['file' => '']);
            } else {
                return redirect()->route('documentos.imovel',  $idImovel)->with(['alert' => 'Erro ao excluir o documento!']);
            }
            return redirect()->route('documentos.imovel',  $idImovel);
        } catch (\Throwable $th) {

            return Redirect::back()->with('alert', $th->getMessage());
        }
    }

    public function uploadItemSocio($idImovel, $idDocumento, $idSocio = null)
    {

        $imovel = Imovel::find($idImovel);
        return view('clientes.imoveis.documentos-upload', compact('idImovel', 'idDocumento', 'idSocio', 'imovel'));
    }


    public function uploadItemImovel($idImovel, $idDocumento)
    {
        $imovel = Imovel::find($idImovel);
        return view('clientes.imoveis.documentos-upload', compact('idImovel', 'idDocumento', 'imovel'));
    }


    public function upload(Request $request)
    {


        if ($request->file('documento')->isValid()) {

            $name = $request->file('documento')->store('documentos/imovel/' . $request->idImovel);
            DocumentImovel::where('imovel_id', $request->idImovel)->where('document_type_id', $request->idDocumento)->update(
                [
                    'file' => $name,
                    //'file_old' => null,
                    'status_documento' => "A ENVIAR"
                ]
            );

            if ($request->idImovel && $request->idSocio) {
                return redirect()->route('documentos.imovel.socio.send', [$request->idImovel, $request->idSocio]);
            } else {

                return redirect()->route('documentos.imovel.send', [$request->idImovel]);
            }
        }
    }

    public function getFile($file, $imovel)
    {

        $file = Storage::disk('public')->get('/documentos/imovel/' . $imovel . '/' . $file);

        return (new Response($file, 200))
            ->header('Content-Type', 'application/pdf');
    }
    public function sendDocumento($idDocumento)
    {

        try {
            if ($idDocumento) {
                $doc = DocumentImovel::where('id', $idDocumento)->first();
                //dd($doc);

                $imovel = Imovel::select('client_id')->where('id', $doc->imovel_id)->first();
                $cliente = Client::select('usuario')->where('id', $imovel->client_id)->first();
                $user = User::findOrFail($cliente->usuario);

                if ($doc && $imovel && $cliente && $user) {

                    $doc->update(['status_documento' => "EM ANALISE"]);
                    $status = "EM ANALISE";

                    $link = url('/') . '/documentos/imovel/' . $doc->imovel_id . '/send/documentos';
                    Mail::to($user->email)->send(new SendMailIteracao($user, $status, $link));
                }

                return redirect()->back();
            }
        } catch (\Throwable $th) {

            return Redirect::back()->withErrors(['alert' => $th->getMessage()]);
        }
    }

    public function StatusDocumento(Request $request)
    {

        $doc = DocumentImovel::where('id', $request->idDocumento)->first();
        $imovel = Imovel::select('client_id')->where('id', $doc->imovel_id)->first();
        $cliente = Client::select('usuario')->where('id', $imovel->client_id)->first();
        $user = User::findOrFail($cliente->usuario);
        $link = url('/') . '/documentos/imovel/' . $doc->imovel_id . '/send/documentos';


        try {
            switch ($request->status_documento) {
                case 'APROVADO':
                    try {
                        if ($request->status_documento == "APROVADO") {
                            $doc->update([
                                'status_documento' => $request->status_documento,
                                'observacao' => $request->observacao,
                                'file_old' => null,
                                'aprovado' => 1

                            ]);
                            Mail::to($user->email)->send(new SendMailIteracaoStatus($user, 'APROVADO', $link));
                        }
                        return redirect()->back();
                    } catch (\Throwable $th) {
                        return Redirect::back()->withErrors(['alert' => $th->getMessage()]);
                    }

                    break;
                case 'REJEITADO':

                    try {
                        if ($request->status_documento == "REJEITADO") {
                            $doc->update([
                                'status_documento' => $request->status_documento,
                                'observacao' => $request->observacao,
                                'aprovado' => 0

                            ]);
                            Mail::to($user->email)->send(new SendMailIteracaoStatus($user, 'REJEITADO', $link));
                        } else {
                            $doc->update([
                                'status_documento' => $request->status_documento,
                                'observacao' => $request->observacao,
                                'file_old' => $doc->file,
                                'file' => null,

                            ]);
                        }
                        return redirect()->back();
                    } catch (\Throwable $th) {
                        return Redirect::back()->withErrors(['alert' => $th->getMessage()]);
                    }

                    break;

                default:
                    return redirect()->back();
                    break;
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(['alert' => $th->getMessage()]);
        }
    }
}
