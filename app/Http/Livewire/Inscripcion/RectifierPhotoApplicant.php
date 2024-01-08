<?php

namespace App\Http\Livewire\Inscripcion;

use Livewire\WithFileUploads;
use App\Models\Postulante;
use Livewire\Component;

class RectifierPhotoApplicant extends Component
{
    use WithFileUploads;

    public $applicant;
    public $photo = [];
    public $observedPhotos;
    public $numberObserved;
    public $disabled = false;
    public $numberPhotos;

    protected function rules()
    {
        $rules = [];
        foreach ($this->observedPhotos as $photo) {
            $rules["photo.{$photo['name']}"] = 'required|mimes:jpeg|max:1024';
        }
        return $rules;
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount(Postulante $applicant, array $observedPhotos)
    {
        $this->observedPhotos = $observedPhotos;
        $this->applicant = $applicant;
        $this->numberPhotos = count($observedPhotos);
        $this->validate();
    }
    public function render()
    {
        if (!$this->getErrorBag()) {
            $this->disabled = true;
        }
        return view('livewire.inscripcion.rectifier-photo-applicant');
    }
    public function store()
    {
        $this->disabled = true;
        $this->validate();
    }
}
