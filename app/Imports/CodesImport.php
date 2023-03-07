<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;

class CodesImport implements WithMultipleSheets, SkipsUnknownSheets
{
    /**
    * @param Collection $collection
    */
    public function sheets(): array
    {
        return [
            'Aguascalientes' => new CodeImport(),
            'Baja_California' => new CodeImport(),
            'Baja_California_Sur' => new CodeImport(),
            'Campeche' => new CodeImport(),
            'Coahuila_de_Zaragoza' => new CodeImport(),
            'Colima' => new CodeImport(),
            'Chiapas' => new CodeImport(),
            'Chihuahua' => new CodeImport(),
            'Distrito_Federal' => new CodeImport(),
            'Durango' => new CodeImport(),
            'Guanajuato' => new CodeImport(),
            'Guerrero' => new CodeImport(),
            'Hidalgo' => new CodeImport(),
            'Jalisco' => new CodeImport(),
            'México' => new CodeImport(),
            'Michoacán_de_Ocampo' => new CodeImport(),
            'Morelos' => new CodeImport(),
            'Nayarit' => new CodeImport(),
            'Nuevo_León' => new CodeImport(),
            'Oaxaca' => new CodeImport(),
            'Puebla' => new CodeImport(),
            'Querétaro' => new CodeImport(),
            'Quintana_Roo' => new CodeImport(),
            'San_Luis_Potosí' => new CodeImport(),
            'Sinaloa' => new CodeImport(),
            'Sonora' => new CodeImport(),
            'Tabasco' => new CodeImport(),
            'Tamaulipas' => new CodeImport(),
            'Tlaxcala' => new CodeImport(),
            'Veracruz_de_Ignacio_de_la_Llave' => new CodeImport(),
            'Yucatán' => new CodeImport(),
            'Zacatecas' => new CodeImport()
        ];
    }

    public function onUnknownSheet($sheetName)
    {
        // E.g. you can log that a sheet was not found.
        info("Sheet {$sheetName} was skipped");
    }
}
