<?php

namespace App\Livewire\Post;

use App\Models\Draft;
use App\Models\Photo;
use App\Models\Post;
use App\Models\PostImg;
use Closure;
use Exception;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithFileUploads;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;


class Create extends Component
{
    use WithFileUploads;

    public $box;
    public $elements;
    public $convertedData;
    public $input;
    public $photo;
    public $bold;
    public $red;
    public $blue;
    public $green;
    public $textMid;
    public $textStart;
    public $textEnd;
    public  $pos;
    public  $img_public_id;






    public function mount()
    {
        $this->box = array(array());
        $this->elements = array();
        $this->input = '';
        $this->convertedData = '';
        $this->red = false;
        $this->blue = false;
        $this->green = false;
        $this->bold = false;
        $this->textMid = false;
        $this->textStart = false;
        $this->textEnd = false;
        $this->pos = count($this->box) - 1;
    }
    public function insert()
    {
        try {
            $this->validate(['input' => 'required']);
            $this->logic('all-false', function () {
                $this->elements[] = $this->input;
            });
            $this->logic('any-true', function () {
                $this->elements[] = $this->convertedData;
                $this->boolManagement('turn-off-all');
            });

            if ($this->pos === count($this->box) - 1) {
                $this->box[] = $this->elements;
            } else  if ($this->pos < count($this->box) - 1) {
                array_splice($this->box, $this->pos + 1, count($this->box), array($this->elements));
            }
            $this->pos = count($this->box) - 1;
            $this->input = '';
            $this->render();
            $this->convertedData = '';
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: "Error: field is blank");
        }
    }

    public function post()
    {
        if (count($this->elements) > 0) {
            // $this->validate(['elements' => 'required']);
            $post = Post::create([
                'body' => implode("\n", $this->elements),
                'user_id' => Auth::user()->id,
            ]);


            $saved_img_from_cloud = array();

            foreach ($this->elements as $element) {

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
            if ($this->img_public_id and $saved_img_from_cloud) {
                $deleted_imgs = array_diff($this->img_public_id, $saved_img_from_cloud);
                foreach ($deleted_imgs as $img_id) {
                    Cloudinary::destroy($img_id);
                }
            }
            redirect("/");
        } else {
            $this->dispatch('show-toast', err: "Error: Cant upload an empty post");
        }
    }
    public function draft()
    {
        try {
            $this->validate(['elements' => 'required']);
            Draft::create([
                'body' => implode($this->elements),
                'user_id' => Auth::user()->id,
            ]);
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: 'Error: Cant save an empty post to draft');
        }
    }
    public function saveImg()
    {
        try {
            $this->validate(['photo' => 'image|max:1024']);

            $cloudImg = $this->photo->storeOnCloudinary('BestPost/post_images');
            $img_url = $cloudImg->getSecurePath();
            $this->img_public_id[] = $cloudImg->getPublicId();
            unlink($this->photo->getRealPath());
            $this->photo = '';
            $img_id = end($this->img_public_id);
            $this->convertedData .= "/img/$img_url/img_id/$img_id";
            $this->elements[] = $this->convertedData;
            // $this->pos = count($this->box)-1;
            $this->convertedData = '';
            // $this->box[] = $this->elements;
            if ($this->pos === count($this->box) - 1) {
                $this->box[] = $this->elements;
            } else  if ($this->pos < count($this->box) - 1) {
                array_splice($this->box, $this->pos + 1, count($this->box), array($this->elements));
            }
            $this->pos = count($this->box) - 1;
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: $e->getMessage());
        }
    }

    #[On('bold')]
    public function toggleBold()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('bold-toggle');
        $this->bold === true ? $this->convertedData .= '/bold/' : $this->convertedData = str_replace('/bold/', '', $this->convertedData);
    }

    #[On('red')]
    public function toggleRed()
    {

        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('red-toggle');

        $this->logic('red-true', function () {
            $this->convertedData = str_replace('/blue/', '', $this->convertedData);
            $this->convertedData = str_replace('/green/', '', $this->convertedData);
            $this->convertedData .= '/red/';
        });
    }

    #[On('blue')]
    public function toggleBlue()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('blue-toggle');

        $this->logic('blue-true', function () {
            $this->convertedData = str_replace('/red/', '', $this->convertedData);
            $this->convertedData = str_replace('/green/', '', $this->convertedData);
            $this->convertedData .= '/blue/';
        });
    }

    #[On('green')]
    public function toggleGreen()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('green-toggle');

        $this->logic('green-true', function () {
            $this->convertedData = str_replace('/red/', '', $this->convertedData);
            $this->convertedData = str_replace('/blue/', '', $this->convertedData);
            $this->convertedData .= '/green/';
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
        $this->pos > 0 ? $this->elements = $this->box[--$this->pos] : '';
    }

    #[On('forward')]
    public function forward()
    {
        $this->pos < count($this->box) - 1 ? $this->elements = $this->box[++$this->pos] : '';
    }

    #[On('text-mid')]
    public function text_mid()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('mid-toggle');
        $this->textMid === true ? $this->convertedData .= '/mid/' : $this->convertedData = str_replace('/mid/', '', $this->convertedData);
        $this->logic('mid-true', function () {
            $this->convertedData = str_replace('/start/', '', $this->convertedData);
            $this->convertedData = str_replace('/end/', '', $this->convertedData);
        });
    }
    #[On('text-start')]
    public function text_start()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('start-toggle');
        $this->textStart === true ? $this->convertedData .= '/start/' : $this->convertedData = str_replace('/start/', '', $this->convertedData);
        $this->logic('start-true', function () {
            $this->convertedData = str_replace('/mid/', '', $this->convertedData);
            $this->convertedData = str_replace('/end/', '', $this->convertedData);
        });
    }
    #[On('text-end')]
    public function text_end()
    {
        !$this->convertedData ? $this->convertedData = $this->input : '';
        $this->boolManagement('end-toggle');
        $this->textEnd === true ? $this->convertedData .= '/end/' : $this->convertedData = str_replace('/end/', '', $this->convertedData);
        $this->logic('end-true', function () {
            $this->convertedData = str_replace('/mid/', '', $this->convertedData);
            $this->convertedData = str_replace('/start/', '', $this->convertedData);
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
        return view('livewire.post.create');
    }
}
