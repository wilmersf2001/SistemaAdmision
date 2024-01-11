<?php

namespace App\Http\Livewire\Admision\Postulante;

use App\Models\Postulante;
use App\Utils\Constants;
use Livewire\Component;

class CarnetEntregado extends Component
{
    public $showAlert = false;

    public function render()
    {
        $postulantes = Postulante::where('estado_postulante_id', Constants::ESTADO_HUELLA_DIGITAL)->paginate(10);
        return view('livewire.admision.postulante.carnet-entregado', compact('postulantes'));
    }

    public function updateStatePostulante(Postulante $postulante)
    {
        $postulante->estado_postulante_id = Constants::ESTADO_CARNET_ENTREGADO;
        $postulante->save();
    }

    public function openAlert()
    {
        $this->showAlert = !$this->showAlert;
    }

    public function updateStateTotalPostulante()
    {
        Postulante::where('estado_postulante_id', Constants::ESTADO_HUELLA_DIGITAL)->update(['estado_postulante_id' => Constants::ESTADO_CARNET_ENTREGADO]);
        $this->showAlert = !$this->showAlert;
    }
}
