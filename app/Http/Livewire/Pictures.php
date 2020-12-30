<?php

namespace App\Http\Livewire;

use App\Models\Picture;
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
    public $picthumbnailUrl;

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

    /**
     * Get all pictures for the questionnaire
     */
    public function readPictures()
    {
        return $this->questionnaire->pictures;
    }

    public function deletePicture()
    {
        if(!is_null($this->pictureId)) Picture::destroy($this->pictureId);

        $this->toggleShowDeleteModal();
    }

    /**
     * Show the delete modal for the specified picture
     * 
     * @param Picture $picture the picture to delete
     */
    public function showDeletePictureModal(Picture $picture)
    {

        $this->pictureId = $picture->id;

        $this->picthumbnailUrl = $picture->thumbnailUrl();

        $this->toggleShowDeleteModal();
        
    }

    /**
     * Toggle the visibility of the upsert modal
     */
    public function toggleShowUpsertModal()
    {
        $this->showUpsertModal = !$this->showUpsertModal;
    }

    /**
     * Toggle the visibility of the delete modal
     */
    public function toggleShowDeleteModal()
    {
        $this->showDeleteModal = !$this->showDeleteModal;
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
