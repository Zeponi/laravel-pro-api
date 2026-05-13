<?php

namespace App\Http\Controllers;

use App\Enums\FreteStatus;
use App\Http\Requests\StoreEtapaRequest;
use App\Models\Etapa;
use App\Models\Frete;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EtapaController extends Controller
{
    public function store(StoreEtapaRequest $request): JsonResponse|Etapa
    {
        $frete = Frete::find($request->frete_id);

        if ($frete->status === FreteStatus::ENTREGUE) {
            return response()->json([
                'message' => 'Não é possível adicionar etapas a um frete que já foi entregue'
            ], 400);
        }

        $etapa = Etapa::create($request->all());

        $tipoFreteStatus = FreteStatus::fromName($request->tipo_etapa);
        $frete->update(['status' => $tipoFreteStatus]);

        return $etapa;
    }
}
