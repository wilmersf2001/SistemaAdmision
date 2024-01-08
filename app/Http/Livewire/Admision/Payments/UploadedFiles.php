<?php

namespace App\Http\Livewire\Admision\Payments;

use Livewire\Component;
use App\Models\ArchivoTxt;

class UploadedFiles extends Component
{
    public $orderDate = 'desc';

    public function render()
    {
        $txtfiles = ArchivoTxt::orderBy('created_at', $this->orderDate)->paginate(10);

        return view('livewire.admision.payments.uploaded-files', compact('txtfiles'));
    }

    public function orderDate()
    {
        $this->orderDate = ($this->orderDate === 'desc') ? 'asc' : 'desc';
    }
}
