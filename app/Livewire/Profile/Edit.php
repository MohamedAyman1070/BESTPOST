<?php

namespace App\Livewire\Profile;

use App\Models\Photo;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $name;
    public $photo;
    public $path;
    public $user_photo;

    public function mount()
    {
        $this->name = auth()->user()->name;
        $this->user_photo = auth()->user()->photos ?? null;
        $this->path = null;
    }

    protected $rules = [
        'name' => 'required|min:3|max:15',
    ];
    public function Edit()
    {
        try {

            if ($this->name == auth()->user()->name && !$this->path) {
                $this->dispatch('show-toast', err: 'nothing changed');
                return;
            }
            $this->validate();
        
            $user = User::find(Auth::user()->id);
            $user->name = $this->name;
            $user->save();
            if ($this->path && $this->path) {
                $photo = Photo::create([
                    'imageable_id' => Auth::user()->id,
                    'imageable_type' => 'App\Models\User',
                    'path' => $this->path
                ]);
                $this->user_photo = $photo;
            }
            $this->dispatch('render-topbar');
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }
    public function save_photo()
    {
        try {
            $this->validate(['photo' =>  'image|max:1024']);
            $this->path = $this->photo->store(path: '/public/uploaded-img/avatar');
            $this->path = str_replace('public', 'storage', $this->path);
            $this->photo = '';
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }


    public function removePhoto()
    {
        if ($this->user_photo) {
            $this->path = null;
            $this->user_photo->delete();
            $this->user_photo = null;
            $this->dispatch('render-topbar');
        } else {
            $this->dispatch('show-toast' , err: "Couldn't find photo");
        }
    }

    public function render()
    {
       
        return view('livewire.profile.edit' );
    }
}
