<?php

namespace App\Livewire\Post;

use App\Models\Photo;
use App\Models\Post;
use Closure;
use Exception;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use phpDocumentor\Reflection\Types\This;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class Edit extends Component
{
    use WithFileUploads;

    public $post;
    public $clone;
    public $box;
    public $test;
    public $row;
    public $photo;
    public $pos;
    public $bold;
    public $red;
    public $blue;
    public $green;
    public $textMid;
    public $textStart;
    public $textEnd;
    public $input;
    public $img_public_id;

    public function mount()
    {
        $this->clone =  explode("\n", $this->post->body);
        $this->box = array();
        $this->box[] = $this->clone;
        $this->test = implode($this->clone);
        $this->photo = null;
        $this->pos = 0;
        $this->red = false;
        $this->blue = false;
        $this->green = false;
        $this->bold = false;
        $this->textMid = false;
        $this->textStart = false;
        $this->textEnd = false;
        $this->row = '';
        $this->img_public_id = array();
    }

    public function edit()
    {
        $post = Post::find($this->post->id);
        $this->authorize('update-delete-post', $post['user_id']);
        $post->body = implode("\n", $this->clone);
        $saved_img_from_cloud = [];
        foreach ($this->clone as $element) {
            if (str_contains($element, '/img/')) {

                $img_id = stristr($element, '/img_id/');
                $img_id = str_replace('/img_id/', '', $img_id);
                $saved_img_from_cloud[] = $img_id;
                $img_url = stristr($element, '/img_id/', true);
                $img_url = str_replace('/img/', '', $img_url);


                Photo::create([
                    'imageable_id' => $post->id,
                    'imageable_type' => 'App\Models\Post',
                    'url' => $img_url,
                    'img_public_id' =>  $img_id,
                ]);
            }
        }
        $post->save();
        $deleted_imgs = array_diff($this->img_public_id, $saved_img_from_cloud);
        foreach ($deleted_imgs as $img_id) {
            Cloudinary::destroy($img_id);
        }
        redirect('/profile/posts');
    }

    #[On('info-uploaded')]
    public function savePhoto($img_info, $element, $pos)
    {
        try {

            $img_url = $img_info[0];
            $this->img_public_id[] = $img_info[1];
            $img_id = end($this->img_public_id);
            $this->row .= "/img/$img_url/img_id/$img_id";
            switch ($pos) {
                case 1:
                    $key = array_search($element, $this->clone);
                    $key++;
                    $key === 1 ? $key = $key - (count($this->clone) + 1) : $key = $key - 1;
                    array_splice($this->clone, $key, 0, $this->row);
                    $this->row = '';
                    $this->box[] = $this->clone;
                    break;
                case -1:
                    $key = array_search($element, $this->clone);
                    array_splice($this->clone, $key + 1, 0, $this->row);
                    $this->row = '';
                    $this->box[] = $this->clone;
                    break;
            }
            $this->pos = count($this->box) - 1;
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }

    public function deleteRow($element)
    {
        $key = array_search($element, $this->clone);
        array_splice($this->clone, $key, 1);
        $this->box[] = $this->clone;
        $this->pos++;
    }

    public function saveRow($element, $pos)
    {

        try {
            $this->validate(['input' => 'required']);
            $this->row .= $this->input;
            switch ($pos) {
                case 1:
                    $key = array_search($element, $this->clone);
                    $key++;
                    $key === 1 ? $key = $key - (count($this->clone) + 1) : $key = $key - 1;
                    array_splice($this->clone, $key, 0, $this->row);
                    break;
                case -1:
                    $key = array_search($element, $this->clone);
                    array_splice($this->clone, $key + 1, 0, $this->row);
                    break;
            }
            $this->row = '';
            $this->input = '';
            $this->box[] = $this->clone;
            $this->pos = count($this->box) - 1;
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }




    #[On('bold')]
    public function toggleBold()
    {
        $this->boolManagement('bold-toggle');
        $this->bold === true ? $this->row .= '/bold/' : $this->row = str_replace('/bold/', '', $this->row);
    }

    #[On('red')]
    public function toggleRed()
    {

        $this->boolManagement('red-toggle');

        $this->logic('red-true', function () {
            $this->row = str_replace('/blue/', '', $this->row);
            $this->row = str_replace('/green/', '', $this->row);
            $this->row .= '/red/';
        });
    }

    #[On('blue')]
    public function toggleBlue()
    {

        $this->boolManagement('blue-toggle');

        $this->logic('blue-true', function () {
            $this->row = str_replace('/red/', '', $this->row);
            $this->row = str_replace('/green/', '', $this->row);
            $this->row .= '/blue/';
        });
    }

    #[On('green')]
    public function toggleGreen()
    {

        $this->boolManagement('green-toggle');

        $this->logic('green-true', function () {
            $this->row = str_replace('/red/', '', $this->row);
            $this->row = str_replace('/blue/', '', $this->row);
            $this->row .= '/green/';
        });
    }

    #[On('white')]
    public function normalText()
    {
        $this->green = false;
        $this->red = false;
        $this->blue = false;
    }

    #[On('back')]
    public function back()
    {
        $this->pos > 0 ? $this->clone = $this->box[--$this->pos] : '';
    }

    #[On('forward')]
    public function forward()
    {
        $this->pos < count($this->box) - 1 ? $this->clone = $this->box[++$this->pos] : '';
    }



    #[On('text-mid')]
    public function text_mid()
    {

        $this->boolManagement('mid-toggle');
        $this->textMid === true ? $this->row .= '/mid/' : $this->row = str_replace('/mid/', '', $this->row);
        $this->logic('mid-true', function () {
            $this->row = str_replace('/start/', '', $this->row);
            $this->row = str_replace('/end/', '', $this->row);
        });
    }
    #[On('text-start')]
    public function text_start()
    {

        $this->boolManagement('start-toggle');
        $this->textStart === true ? $this->row .= '/start/' : $this->row = str_replace('/start/', '', $this->row);
        $this->logic('start-true', function () {
            $this->row = str_replace('/mid/', '', $this->row);
            $this->row = str_replace('/end/', '', $this->row);
        });
    }
    #[On('text-end')]
    public function text_end()
    {

        $this->boolManagement('end-toggle');
        $this->textEnd === true ? $this->row .= '/end/' : $this->row = str_replace('/end/', '', $this->row);
        $this->logic('end-true', function () {
            $this->row = str_replace('/mid/', '', $this->row);
            $this->row = str_replace('/start/', '', $this->row);
        });
    }




    private function logic(string $condition, Closure $closure): void
    {
        switch ($condition) {
            case 'red-false':
                if ($this->red === false) {
                    $closure();
                }
                break;
            case 'red-true':
                if ($this->red === true) {
                    $closure();
                }
                break;
            case 'blue-true':
                if ($this->blue === true) {
                    $closure();
                }
                break;
            case 'green-true':
                if ($this->green === true) {
                    $closure();
                }
            case 'mid-true':
                if ($this->textMid === true) {
                    $closure();
                }
                break;
            case 'start-true':
                if ($this->textStart === true) {
                    $closure();
                }
                break;
            case 'end-true':
                if ($this->textEnd === true) {
                    $closure();
                }
                break;
            case 'all-false':
                if ($this->red === false && $this->green === false && $this->blue === false && $this->bold === false && $this->textMid === false && $this->textStart === false && $this->textEnd === false) {

                    $closure();
                }
                break;
            case 'any-true':
                if ($this->red === true || $this->green === true || $this->blue === true || $this->bold === true || $this->textMid === true || $this->textStart === true || $this->textEnd === true) {

                    $closure();
                }
                break;
        }
    }
    private function boolManagement(string $atter): void
    {

        switch ($atter) {
            case 'red-toggle':
                $this->red === true ? $this->red = false : $this->red = true;
                $this->green = false;
                $this->blue = false;
                break;
            case 'green-toggle':
                $this->green === true ? $this->green = false : $this->green = true;
                $this->red = false;
                $this->blue = false;
                break;
            case 'blue-toggle':
                $this->blue === true ? $this->blue = false : $this->blue = true;
                $this->green = false;
                $this->red = false;
                break;
            case 'bold-toggle':
                $this->bold === true ? $this->bold = false : $this->bold = true;
                break;
            case 'mid-toggle':
                $this->textMid === true ? $this->textMid = false : $this->textMid = true;
                $this->textStart = false;
                $this->textEnd = false;
                break;
            case 'start-toggle':
                $this->textStart === true ? $this->textStart = false : $this->textStart = true;
                $this->textMid = false;
                $this->textEnd = false;
                break;
            case 'end-toggle':
                $this->textEnd === true ? $this->textEnd = false : $this->textEnd = true;
                $this->textMid = false;
                $this->textStart = false;
                break;
            case 'turn-off-all':
                $this->red = false;
                $this->green = false;
                $this->blue = false;
                $this->bold = false;
                $this->textMid = false;
                $this->textStart = false;
                $this->textEnd = false;
        }
    }


    public function render()
    {
        return view('livewire.post.edit');
    }
}
