<?php

namespace App\Livewire\Profile;

use App\Models\Photo;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $name;
    public $photo;
    public $path;
    public $user_photo;
    public $img_public_id;
    public $img_url;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->user_photo = auth()->user()->photos ?? null;
        $this->path = null;
        $this->img_public_id = array();
    }

    protected $rules = [
        'name' => 'required|min:3|max:15',
    ];
    public function Edit()
    {
        try {

            if ($this->name == auth()->user()->name && !$this->img_url) {
                $this->dispatch('show-toast', err: 'nothing changed');
                return;
            }
            $this->validate();

            $user = User::find(Auth::user()->id);
            $user->name = $this->name;
            $user->save();
            if ($this->img_url) {
                $photo = Photo::create([
                    'imageable_id' => Auth::user()->id,
                    'imageable_type' => 'App\Models\User',
                    'url' => $this->img_url,
                    'img_public_id' =>  array_pop($this->img_public_id),
                ]);
                foreach ($this->img_public_id as $id) {
                    Cloudinary::destroy($id);
                }
                $this->user_photo = $photo;
            }
            $this->dispatch('render-topbar');
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }
    #[On('img-uploaded')]
    public function save_photo($img_info)
    {
        try {

            if ($this->user_photo) {
                Cloudinary::destroy($this->user_photo->img_public_id);
            }

            $this->img_url = $img_info[0];
            $img_id = $img_info[1];
            $this->img_public_id[] = $img_id;
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }


    public function removePhoto()
    {
        if ($this->user_photo) {
            $this->path = null;
            $this->user_photo->delete();
            Cloudinary::destroy($this->user_photo->img_public_id);
            $this->user_photo = null;
            $this->img_url = null;
            $this->dispatch('render-topbar');
        } else {
            $this->dispatch('show-toast', err: "Couldn't find photo");
        }
    }

    public function render()
    {

        return view('livewire.profile.edit');
    }
}
