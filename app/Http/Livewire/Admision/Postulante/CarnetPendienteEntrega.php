<?php

namespace App\Http\Livewire\Admision\Postulante;

use Livewire\Component;
use App\Models\Postulante;
use App\Utils\Constants;

class CarnetPendienteEntrega extends Component
{
    public $showAlert = false;

    public function render()
    {
        $postulantes = Postulante::where('estado_postulante_id', Constants::ESTADO_VALIDO)->paginate(10);
        return view('livewire.admision.postulante.carnet-pendiente-entrega', compact('postulantes'));
    }

    public function updateStatePostulante(Postulante $postulante)
    {
        $postulante->estado_postulante_id = Constants::ESTADO_CARNET_IMPRESO_PENDIENTE;
        $postulante->save();
    }

    public function openAlert()
    {
        $this->showAlert = !$this->showAlert;
    }

    public function updateStateTotalPostulante()
    {
        Postulante::where('estado_postulante_id', Constants::ESTADO_VALIDO)->update(['estado_postulante_id' => Constants::ESTADO_CARNET_IMPRESO_PENDIENTE]);
        $this->showAlert = !$this->showAlert;
    }
}
