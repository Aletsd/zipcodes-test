<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use App\Models\Code;
use App\Models\Locality;
use App\Models\Municipality;
use App\Models\Settlement_type;
use App\Models\Settlement;
use App\Models\State;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Row;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\OnEachRow;


class CodeImport implements OnEachRow, WithHeadingRow, WithBatchInserts
{
    /**
    * @param array $row
    */
    public function onRow(Row $row)
    {


        $state = State::firstOrCreate([
            'key' => $row['c_estado'],
            'name' => strtoupper($row['d_estado']),
            'code' => $row['c_cp']
        ]);

        $municipality = Municipality::firstOrCreate([
            'key' => $row['c_mnpio'],
            'name' => strtoupper($row['d_mnpio']),
            'state_id' => $state -> id
        ]);

        $locality = Locality::firstOrCreate([
            'zip_code' => $row['d_codigo'],
            'locality' => $row['d_ciudad'] != Null ? strtoupper($row['d_ciudad']) : "",
            'state_id' => $state->id,
            'municipality_id' => $municipality -> id
        ]);

        $settlement_type = Settlement_type::firstOrCreate([
            'name' => $row['d_tipo_asenta']
        ]);

        $settlement = Settlement::create([
            'key' => $row['id_asenta_cpcons'],
            'name' => strtoupper($row['d_asenta']),
            'zone_type' => strtoupper($row['d_zona']),
            'locality_id' => $locality -> id,
            'settlement_type_id' => $settlement_type -> id
        ]);




    }

    public function batchSize(): int
    {
        return 200;
    }
}
