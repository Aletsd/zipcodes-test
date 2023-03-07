<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\CodesImport;
use App\Models\Locality;
use Illuminate\Support\Facades\DB;

use function PHPUnit\Framework\isNull;

class HomeController extends Controller
{
    public function home()
    {

        $import = new CodesImport();
        Excel::import($import, 'CPdescarga.xls');
        echo "hola";
        return view('welcome');
    }

    public function store()
    {
        $import = new CodesImport();
        Excel::import($import, 'CPdescarga.xls');
        echo "hola";
    }


    public function searchCodePostal($cp)
    {

        try {

            $locality = Locality::with('federal_entity', 'settlements', 'municipality')->where('zip_code', $cp)->first();
            if ($locality == Null)
                return response()->json(['zip_code' => "not found"]);
            $settlements = array();

            foreach ($locality?->settlements as $settlement) {
                $settlements[]  = [
                    "key" => $settlement->key,
                    "name" => $settlement->name,
                    "zone_type" => $settlement->zone_type,
                    "settlement_type" => array(
                        "name" => $settlement->settlement_type->name
                    )
                ];
            }

            $array = array(
                'zip_code' => $locality->zip_code,
                'locality' => $locality->locality,
                'federal_entity' => array(
                    'key' => $locality->federal_entity->key,
                    'name' => $locality->federal_entity->name,
                    'code' => $locality->federal_entity->code
                ),
                "settlements" => $settlements,
                'municipality' => array(
                    'key' => $locality->municipality->key,
                    'name' => $locality->municipality->name
                ),
            );




            return response()->json($array);
        } catch (\Throwable $th) {

            $status = $th->getMessage();
            return response()->json(['status' => $status])->setStatusCode(500);
        }
    }
}
