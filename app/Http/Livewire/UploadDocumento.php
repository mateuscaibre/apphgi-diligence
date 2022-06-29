<?php

namespace App\Http\Livewire;

use App\Models\Imovel;
use Illuminate\Support\Facades\DB;
use Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class UploadDocumento extends Component
{
    use WithFileUploads;
    public $arquivo;

    public function save()
    {
        //dd($this->arquivo);
        $this->arquivo->store('arquivos');

    }

    public function render()
    {

        $idImovel = Request::segment(3);
        $documentos = DB::table('document_imovels')
            ->join('document_types', 'document_imovels.document_type_id', '=', 'document_types.id')
            ->select('*')
            ->where('imovel_id', $idImovel)

            ->get();



        $imovel = Imovel::find($idImovel);

        return view('livewire.componentes.documentos.upload-documento', compact('imovel', 'documentos'));
    }
}
