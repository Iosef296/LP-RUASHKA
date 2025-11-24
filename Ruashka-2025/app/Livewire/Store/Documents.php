<?php

namespace App\Livewire\Store;

use App\Models\StoreDocument;
use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Documents extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $search = '';
    public $showModal = false;

    public $title;
    public $category;
    public $description;
    public $file;

    protected $rules = [
        'title' => 'required|string|max:255',
        'category' => 'required|string|max:255',
        'description' => 'nullable|string',
        'file' => 'required|file|max:10240',
    ];

    public function render()
    {
        $documents = StoreDocument::query()
            ->where('store_id', 1)
            ->where('title', 'like', '%' . $this->search . '%')
            ->paginate(10);

        return view('livewire.store.documents', [
            'documents' => $documents,
        ]);
    }

    public function create()
    {
        $this->resetInputFields();
        $this->showModal = true;
    }

    public function store()
    {
        $this->validate();

        $path = $this->file->store('store-documents', 'public');

        StoreDocument::create([
            'store_id' => 1,
            'title' => $this->title,
            'category' => $this->category,
            'file_path' => $path,
            'description' => $this->description,
        ]);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public $documentId;
    public $editMode = false;

    public function edit($id)
    {
        $document = StoreDocument::findOrFail($id);
        $this->documentId = $id;
        $this->title = $document->title;
        $this->category = $document->category;
        $this->description = $document->description;

        $this->editMode = true;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:255',
            'description' => 'nullable|string',
            'file' => 'nullable|file|max:10240',
        ]);

        $document = StoreDocument::findOrFail($this->documentId);

        $data = [
            'title' => $this->title,
            'category' => $this->category,
            'description' => $this->description,
        ];

        if ($this->file) {
            if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
                \Storage::disk('public')->delete($document->file_path);
            }

            $path = $this->file->store('store-documents', 'public');
            $data['file_path'] = $path;
        }

        $document->update($data);

        $this->showModal = false;
        $this->resetInputFields();
    }

    public function delete($id)
    {
        $document = StoreDocument::find($id);
        if ($document->file_path && \Storage::disk('public')->exists($document->file_path)) {
            \Storage::disk('public')->delete($document->file_path);
        }
        $document->delete();
    }

    private function resetInputFields()
    {
        $this->title = '';
        $this->category = '';
        $this->description = '';
        $this->file = null;
        $this->documentId = null;
        $this->editMode = false;
    }
}
