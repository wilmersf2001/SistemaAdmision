<?php

namespace App\Http\Livewire\Admision;


use Livewire\Component;
use App\Utils\Constants;
use Livewire\WithPagination;
use App\Models\Proceso;
use App\Models\Postulante;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class ApplicantPhotos extends Component
{
    use WithPagination;
    public $fileStatus;
    public $file;
    public $latestDate = 0;
    public $isProcessOpen = false;
    public $currentRoute;

    public function mount($file, $fileStatus)
    {
        $this->file = $file;
        $this->fileStatus = $fileStatus;
        $this->isProcessOpen = Proceso::processOpen();
        $this->currentRoute =  Route::current()->uri();
    }

    public function render()
    {
        $applicantIdList = [];
        $listUrlPhotoAndDni = $this->getApplicantDni();
        $dniApplicants = array_keys($listUrlPhotoAndDni);
        $applicantPagination = Postulante::whereIn('num_documento', $dniApplicants)
            ->where('estado_postulante_id', '<>', Constants::ESTADO_INSCRIPCION_ANULADA)
            ->paginate(10);
        $totalApplicants = Postulante::whereIn('num_documento', $dniApplicants)
            ->where('estado_postulante_id', '<>', Constants::ESTADO_INSCRIPCION_ANULADA)
            ->get();
        $applicantIdList = $totalApplicants->pluck('id')->all();

        return view('livewire.admision.applicant-photos', compact('applicantPagination', 'totalApplicants', 'applicantIdList', 'listUrlPhotoAndDni'));
    }

    private function searchFotoCarnetByDni($dni)
    {
        $sourcePathFotoCarnet = $this->file . Constants::CARPETA_FOTO_CARNET;
        $nameFile = $dni . '.jpg';
        $urlPhotoValid = $sourcePathFotoCarnet . $nameFile;
        if (Storage::disk(Constants::DISK_STORAGE)->exists($urlPhotoValid)) {
            return Storage::url($urlPhotoValid);
        }
        return 0;
    }

    private function searchDniAnversoByDni($dni)
    {
        $sourcePathDniAnverso = $this->file . Constants::CARPETA_DNI_ANVERSO;
        $nameFile = 'A-' . $dni . '.jpg';
        $urlPhotoValid = $sourcePathDniAnverso . $nameFile;
        if (Storage::disk(Constants::DISK_STORAGE)->exists($urlPhotoValid)) {
            return Storage::url($urlPhotoValid);
        }
        return 0;
    }

    private function searchDniReversoByDni($dni)
    {
        $sourcePathDniReverso = $this->file . Constants::CARPETA_DNI_REVERSO;
        $nameFile = 'R-' . $dni . '.jpg';
        $urlPhotoValid = $sourcePathDniReverso . $nameFile;
        if (Storage::disk(Constants::DISK_STORAGE)->exists($urlPhotoValid)) {
            return Storage::url($urlPhotoValid);
        }
        return 0;
    }

    public function getApplicantDni()
    {
        $recentImageName = $this->getDniByFile($this->file);
        $postulanteInscritoWeb = Postulante::where('estado_postulante_id', $this->fileStatus)->pluck('num_documento')->toArray();
        $listUrlPhotoAndDni = [];

        if ($recentImageName) {
            foreach ($recentImageName as $imageName) {
                if (in_array($imageName, $postulanteInscritoWeb)) {
                    $responseFotoCarnet = $this->searchFotoCarnetByDni($imageName);
                    $responseDniAnverso = $this->searchDniAnversoByDni($imageName);
                    $responseDniReverso = $this->searchDniReversoByDni($imageName);

                    $listUrlPhotoAndDni[$imageName] = [$responseDniAnverso, $responseDniReverso, $responseFotoCarnet];
                }
            }
        }

        return $listUrlPhotoAndDni;
    }

    public function getDniByFile($file)
    {
        $profilePhotoFolderFile = Storage::files('public/' . $file . Constants::CARPETA_FOTO_CARNET);
        $dniAnversoFolderFile = Storage::files('public/' . $file . Constants::CARPETA_DNI_ANVERSO);
        $dniReversoFolderFile = Storage::files('public/' . $file . Constants::CARPETA_DNI_REVERSO);

        if (!empty($profilePhotoFolderFile)) {
            $ultimoArchivo = end($profilePhotoFolderFile);
            $this->latestDate = Storage::lastModified($ultimoArchivo);
        }

        $namesProfilePhoto = array_map('basename', $profilePhotoFolderFile);
        $namesDniAnverso = array_map(function ($file) {
            return str_replace("A-", "", basename($file));
        }, $dniAnversoFolderFile);
        $namesDniReverso = array_map(function ($file) {
            return str_replace("R-", "", basename($file));
        }, $dniReversoFolderFile);

        if ($this->currentRoute == 'archivos-validos' || $this->currentRoute == 'archivos-rectificados-validos') {
            $namesProfilePhotoWithoutExtension = array_map('pathinfo', $namesProfilePhoto, array_fill(0, count($namesProfilePhoto), PATHINFO_FILENAME));
            $namesDniAnversoWithoutExtension = array_map('pathinfo', $namesDniAnverso, array_fill(0, count($namesDniAnverso), PATHINFO_FILENAME));
            $namesDniReversoWithoutExtension = array_map('pathinfo', $namesDniReverso, array_fill(0, count($namesDniReverso), PATHINFO_FILENAME));
            $fileNamesValid = array_intersect($namesProfilePhotoWithoutExtension, $namesDniAnversoWithoutExtension, $namesDniReversoWithoutExtension);

            return $fileNamesValid;
        }

        if ($this->currentRoute == 'archivos-observados' || $this->currentRoute == 'archivos-rectificar') {
            $allFileNames = array_merge($namesProfilePhoto, $namesDniAnverso, $namesDniReverso);
            $fileNamesObserved = array_unique($allFileNames);
            $fileNamesObserved = array_map(function ($file) {
                return str_replace(".jpg", "", $file);
            }, $fileNamesObserved);
            return $fileNamesObserved;
        }
    }
}
