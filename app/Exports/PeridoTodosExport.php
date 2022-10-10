<?php

namespace App\Exports;

use App\Model\Periodo;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;


class PeridoTodosExport implements FromCollection,WithHeadings,WithMapping

{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //if (getSeccion()) {
        //    return Periodo::where('',getIdSeccion())->get();

        //}else{
            return Periodo::all();
        //}
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
