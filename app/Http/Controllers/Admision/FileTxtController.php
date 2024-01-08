<?php

namespace App\Http\Controllers\Admision;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreArchivoTxtRequest;
use App\Utils\Constants;
use App\Models\ArchivoTxt;
use App\Models\Banco;

class FileTxtController extends Controller
{
    private function processLines($lineas, $archivoTxt)
    {
        $bancoCreated = false;

        foreach ($lineas as $linea) {
            $num_voucher = substr($linea, 18, 7);
            $tipo_doc = substr($linea, 25, 2);
            $concepto = substr($linea, 35, 8);
            $relleno_do = substr($linea, 47, 7);
            $num_doc = substr($linea, 54, 8);
            $importe = intval(substr($linea, 62, 15)) / 100;
            $fecha = substr($linea, 79, 4) . "-" . substr($linea, 83, 2) . "-" . substr($linea, 85, 2);
            $hora = substr($linea, 87, 2) . ":" . substr($linea, 89, 2) . ":" . substr($linea, 91, 2);
            $cod_age = substr($linea, 97, 4);

            if ($tipo_doc == '09') {
                $num_doc = ltrim($relleno_do . $num_doc, '0');
            }

            if (in_array(ltrim($concepto, '0'), Constants::NUMERO_CONCEPTO_ADMISION)) {
                Banco::create([
                    'num_oficina' => $cod_age,
                    'cod_concepto' => substr($concepto, 3),
                    'tipo_doc_pago' => 1,
                    'num_documento' => $num_voucher,
                    'importe' => $importe,
                    'fecha' => $fecha,
                    'hora' => $hora,
                    'estado' => 0,
                    'num_doc_depo' => $num_doc,
                    'tipo_doc_depo' => $tipo_doc,
                    'archivo_txt_id' => $archivoTxt->id,
                ]);
                $bancoCreated = true;
            }
        }

        $archivoTxt->update([
            'cantidad_registros' => Banco::where('archivo_txt_id', $archivoTxt->id)->count(),
        ]);

        return $bancoCreated;
    }

    public function store(StoreArchivoTxtRequest $request)
    {
        DB::beginTransaction();

        try {
            $filetxt = $request->file('filetxt');

            if (!$filetxt->isValid()) {
                throw new \Exception('El archivo no se cargó correctamente');
            }

            $datatxt = file_get_contents($filetxt);
            $namefile = strtolower($filetxt->getClientOriginalName());
            $lineas = explode("\n", $datatxt);
            $filestxt = ArchivoTxt::all();

            if ($filestxt->contains('nombre', $namefile)) {
                return redirect()->route('home.uploadedFiles')->with('error', 'El archivo ya fue cargado anteriormente');
            }

            $archivoTxt = ArchivoTxt::create([
                'nombre' => $namefile,
                'cantidad_registros' => count($lineas),
            ]);

            $bancoCreated = $this->processLines($lineas, $archivoTxt);

            if (!$bancoCreated) {
                throw new \Exception('No se encontro ningun registro de pago admisión en el archivo txt');
            }

            DB::commit();

            return redirect()->route('home.uploadedFiles')->with('success', 'El archivo fue cargado correctamente a la base de datos');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('home.uploadedFiles')->with('error', $e->getMessage());
        }
    }
}
