<?php

namespace App\Exports;

use App\Model\Periodo;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Http\Request;

class PeriodoExport implements FromQuery
{
    /**
     * @return \Illuminate\Support\Collection
     */
    use Exportable;


    public function __construct(Request $request)
    {
        
    }

    public function headings(): array
    {
        return [
            'id_periodo',
            'anio',
            'peri_insc_inic',
            'peri_insc_fin',
            'peri_eval_inic',
            'peri_eval_fin',
            'created_at',
            'updated_at',
            'user_regi',
            'user_actu',
            'id_seccion',
        ];
    }

    public function map($perido): array
    {
        return [
            $perido->id_periodo,
            $perido->anio,
            $perido->peri_insc_inic,
            $perido->peri_insc_fin,
            $perido->peri_eval_inic,
            $perido->peri_eval_fin,
            $perido->created_at,
            $perido->updated_at,
            $perido->user_regi,
            $perido->user_actu,
            $perido->id_seccion,
        ];
    }
}
