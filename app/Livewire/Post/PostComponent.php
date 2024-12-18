<?php

namespace App\Livewire\Post;

use App\Events\CommentsEvent;
use App\Events\ReactsEvent;
use App\Livewire\Profile\Post;
use App\Models\Comment;
use App\Models\Draft;
use App\Models\Photo;
use App\Models\Post as ModelsPost;
use App\Models\React;
use App\Models\User;
use Carbon\Carbon;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use DateTime;
use Exception;
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
    public $is_follow;
    public $is_in_draft = false;


    public function mount()
    {
        $this->post['body'] = explode("\n", $this->post['body']);



        $this->comments = array_reverse($this->post['comments']);
        $this->comments_counter = count($this->comments);


        if (auth()->user()) {
            auth()->user()->following->find($this->post['user_id']) ? $this->is_follow = true : $this->is_follow = false;
        }

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

    #[On('echo:react-channel,ReactsEvent')]
    public function renderReactions()
    {
        $react_array = ModelsPost::find($this->post['id'])->reacts->toArray();
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
        if (!Auth::user()):
            redirect()->route('login');
        else:
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
            $this->reaction_handler('DB'); // this will save time for the current user
            broadcast(new ReactsEvent())->toOthers(); //this will take a little time for other users
        endif;
    }

    public function follow()
    {

        if (!Auth::user()):
            redirect()->route('login');
        else:
            $this->authorize('follow', $this->post['user_id']);
            $user = User::find(Auth::id());
            $user->following()->attach($this->post['user_id']);
            $this->is_follow = true;
            $this->dispatch('render');
        endif;
    }
    public function unfollow()
    {
        if (!Auth::user()):
            redirect()->route('login');
        else:
            $this->authorize('unfollow', $this->post['user_id']);
            $user = User::find(Auth::id());
            $user->following()->detach($this->post['user_id']);
            $this->is_follow = false;
            $this->dispatch('render');

        endif;
    }

    #[On('render')]
    public function renderFollowBtn()
    {
        auth()->user()->following->find($this->post['user_id']) ? $this->is_follow = true : $this->is_follow = false;
    }

    public function delete()
    {

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
        try {
            if (!Auth::user()):
                redirect()->route('login');
            else:
                $this->validate(['comment_body' => 'required']);
                Comment::create([
                    'user_id' => Auth::id(),
                    'body' => $this->comment_body,
                    'post_id' => $this->post['id'],
                ]);
                $this->reset('comment_body');
                broadcast(new CommentsEvent($this->post['id']));
            endif;
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: "Cannot submit an empty comment!");
        }
    }

    #[On(['echo:comments-channel,CommentsEvent'])]
    public function renderComments($payload)
    {
        if (isset($payload['post_id'])) {
            if ($payload['post_id'] == $this->post['id']):
                $current_comments = Comment::latest()->where('post_id', $this->post['id'])->get()->toArray();
                $this->comments = $current_comments;
                $this->comments_counter = count($current_comments);
            endif;
        }
    }

    public function render()
    {
        return view('livewire.post.post-component');
    }
}
