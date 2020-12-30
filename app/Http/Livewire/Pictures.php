<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\Questionnaire;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class Pictures extends Component
{
    use WithFileUploads;
    
    public Questionnaire $questionnaire;

    public $showUpsertModal = false;
    public $showDeleteModal = false;

    public $alt;
    public $picture;

    public $pictureId;

    public function rules()
    {
        return [
            'picture' => ['required', 'image', 'max:2048'],
            'alt' => ['required']
        ];
    }

    /**
     * Called when mounting the component
     */
    public function mount(Questionnaire $questionnaire)
    {
        $this->questionnaire = $questionnaire;
    }
    
    public function render()
    {
        return view('livewire.pictures', [
            'pictures' => $this->readPictures()
        ]);
    }

    /**
     * Persist the picture to the database
     */
    public function createPicture()
    {
        //Validate the image
        $this->validate();

        //Save the image
        $path = $this->picture->store('questionnaires/pictures', 'public');

        //Create Thumbnail
        $image = Image::make($this->picture->getRealPath())->fit(600, 400);

        $thumbnail = "questionnaires/pictures/" . Str::random(16) . '.' . $this->picture->extension();

        $image->save(public_path('storage/' . $thumbnail), 33); //33% quality

        //Store the picture and the details
        $this->questionnaire->pictures()->create([
            'alt' => $this->alt,
            'path' => $path,
            'thumbnail' => $thumbnail
        ]);

        info('Picture Saved');

        $this->toggleShowUpsertModal();
    }

    public function readPictures()
    {
        return $this->questionnaire->pictures;
    }

    /**
     * Toggle the visibility of the upsert modal
     */
    public function toggleShowUpsertModal()
    {
        $this->showUpsertModal = !$this->showUpsertModal;
    }

    /**
     * Clear Cache When you close modal
     */
    public function updatedsShowUpsertModal($flag)
    {
        if(!$flag){
            $this->reset(['alt', 'picture', 'pictureId']);
        }
    }

}
