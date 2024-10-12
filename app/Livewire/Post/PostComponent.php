<?php

namespace App\Livewire\Post;

use App\Livewire\Profile\Post;
use App\Models\Comment;
use App\Models\Photo;
use App\Models\Post as ModelsPost;
use App\Models\React;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DateTime;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;
use LogicException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostComponent extends Component
{

    public $post;
    public $since;
    public $react_counter;
    public $comment_body;
    public $comments;
    public $comments_counter;


    public function mount()
    {

        $this->post['body'] = explode("\n", $this->post['body']);

        $this->comments = array_reverse($this->post['comments']);
        $this->comments_counter = count($this->comments);

        // $this->comments = ModelsPost::find($this->post['id'])::with('comments')->get();

        $this->reaction_handler();


        $this->since = Carbon::now();
        $post_dt  = new Carbon($this->post['created_at']);
        $this->since = $post_dt->diffForHumans($this->since);
        $this->since = str_replace('before', 'ago', $this->since);
    }
    private function reaction_handler($mode = 'normal')
    {
        if ($mode === 'normal') {
            $react_array = $this->post['reacts'];
        } elseif ($mode === 'DB') {
            $react_array = ModelsPost::find($this->post['id'])->reacts->toArray();
        }
        $this->react_counter = ['love' => 0, 'lough' => 0, 'sad' => 0,  'anger' => 0, 'wow' => 0, 'all' => 0];
        foreach ($react_array as $arr) {
            switch ($arr['react']) {
                case 'love':
                    $this->react_counter['love']++;
                    $this->react_counter['all']++;
                    break;
                case 'lough':
                    $this->react_counter['lough']++;
                    $this->react_counter['all']++;
                    break;
                case 'anger':
                    $this->react_counter['anger']++;
                    $this->react_counter['all']++;
                    break;
                case 'wow':
                    $this->react_counter['wow']++;
                    $this->react_counter['all']++;
                    break;
                case 'sad':
                    $this->react_counter['sad']++;
                    $this->react_counter['all']++;
                    break;
                default:
                    return new LogicException;
                    break;
            }
        }
    }


    public function react($reaction)
    {

        $data = [
            'reactable_id' => $this->post['id'],
            'reactable_type' => 'App\Models\Post',
            'user_id' => auth()->user()->id,
        ];
        switch ($reaction) {
            case 'love':
                $data['react'] = 'love';
                break;
            case 'lough':
                $data['react'] = 'lough';
                break;
            case 'anger':
                $data['react'] = 'anger';
                break;
            case 'wonder':
                $data['react'] = 'wow';
                break;
            case 'sad':
                $data['react'] = 'sad';
                break;
            default:
                return new LogicException();
        }


        if ($reaction_obj = React::where('user_id', auth()->user()->id)->where('reactable_id', $this->post['id'])->first()) {

            if ($reaction_obj->react === $data['react']) {
                $reaction_obj->delete();
            } else {
                $reaction_obj->react = $data['react'];
                $reaction_obj->save();
            }
        } else {
            React::create($data);
        }


        // $this->react_counter[$data['react']]++;
        $this->reaction_handler('DB');
    }

    public function follow() {}

    public function delete()
    { // Issue # DOM  not rendered immediately after deletion

        $this->authorize('update-delete-post', $this->post['user_id']);
        ModelsPost::all()->where('id', $this->post['id'])->first()->delete();
        $photos_array = $this->post['photos'];
        foreach ($photos_array as $photo) {
            Photo::where('img_public_id', $photo['img_public_id'])->first()->delete();
            Cloudinary::destroy($photo['img_public_id']);
        }
        $this->dispatch('delete-post');
    }



    public function comment()
    {
        $this->validate(['comment_body' => 'required']);
        Comment::create([
            'user_id' => Auth::id(),
            'body' => $this->comment_body,
            'post_id' => $this->post['id'],
        ]);
        $this->comments = Comment::latest()->where('post_id', $this->post['id'])->get()->toArray();
        $this->comments_counter = count($this->comments);
    }

    #[On('delete-comment')]
    public function renderComments()
    {
        $this->comments = Comment::latest()->where('post_id', $this->post['id'])->get()->toArray();
        $this->comments_counter = count($this->comments);
    }


    public function render()
    {
        return view('livewire.post.post-component');
    }
}
