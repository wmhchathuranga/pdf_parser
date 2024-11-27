<?php

namespace App\Livewire;
use Livewire\Attributes\On; 
use Livewire\Component;

class ProgressBar extends Component
{

    public $successCount = 0;
    public $errorCount = 0;
    public $pdfCount = 1;

    protected $listeners = ['updatePdfCount'];

    // #[on('file-count')]
    // public function definePdfCount($pdfCount){
    //     $this->pdfCount = $pdfCount;
    //     dd($this->pdfCount);
    //     // $this->render();
    // }

    public function updatePdfCount($pdfCount)
    {
        $this->pdfCount = $pdfCount;
        dd($this->pdfCount);
    }
    
    public function incrementSuccess()
    {
        $this->successCount++;
    }

    public function incrementError()
    {
        $this->errorCount++;
    }

    public function render()
    {
        return view('livewire.progress-bar');
    }
}
