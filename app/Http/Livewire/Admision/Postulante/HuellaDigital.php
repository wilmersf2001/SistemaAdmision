<?php

namespace App\Http\Livewire\Admision\Postulante;

use Livewire\Component;
use App\Models\Postulante;
use App\Utils\Constants;

class HuellaDigital extends Component
{
    public $showAlert = false;

    public function render()
    {
        $postulantes = Postulante::where('estado_postulante_id', Constants::ESTADO_CARNET_IMPRESO_PENDIENTE)->paginate(10);

        return view('livewire.admision.postulante.huella-digital', compact('postulantes'));
    }

    public function updateStatePostulante(Postulante $postulante)
    {
        $postulante->estado_postulante_id = Constants::ESTADO_HUELLA_DIGITAL;
        $postulante->save();
    }

    public function openAlert()
    {
        $this->showAlert = !$this->showAlert;
    }

    public function updateStateTotalPostulante()
    {
        Postulante::where('estado_postulante_id', Constants::ESTADO_CARNET_IMPRESO_PENDIENTE)->update(['estado_postulante_id' => Constants::ESTADO_HUELLA_DIGITAL]);
        $this->showAlert = !$this->showAlert;
    }
}
