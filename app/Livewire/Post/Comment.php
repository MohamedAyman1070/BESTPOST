<?php

namespace App\Livewire\Post;

use App\Events\CommentsEvent;
use App\Events\ReactsEvent;
use App\Models\Comment as ModelsComment;
use App\Models\React;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Component;
use LogicException;

class Comment extends Component
{
    public $comment;
    public $owner;
    public $reacts;
    public $since;
    public $comment_body; //for nested comments
    public $parent_id;
    public $nested_comments;
    public $nested_comments_counter;

    public $react_counter;

    public function mount()
    {
        $this->owner = $this->comment['user'];
        $this->reacts = $this->comment['reacts'];
        $now = Carbon::now();
        $created_at = new Carbon($this->comment['created_at']);
        $this->since = $created_at->diffForHumans($now);
        $this->since = str_replace('before', 'ago', $this->since);
        $this->reaction_handler();
        $this->nested_comments = $this->comment['children'];
        $this->nested_comments_counter = count($this->nested_comments);
    }

    private function reaction_handler($mode = 'normal')
    {
        if ($mode === 'normal') {
            $react_array = $this->comment['reacts'];
        } elseif ($mode === 'DB') {
            $react_array = ModelsComment::find($this->comment['id'])->reacts->toArray();
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
                    return new LogicException();
                    break;
            }
        }
    }

    #[On('echo:react-chaneel,ReactsEvent')]
    public function renderReactions()
    {
        $react_array = ModelsComment::find($this->comment['id'])->reacts->toArray();
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
                    return new LogicException();
                    break;
            }
        }
    }

    public function delete($comment_id)
    {
        $this->authorize('update-delete-comment', [Auth::id(), $this->comment['user_id']]);
        $comment_to_delete  = ModelsComment::find($comment_id);
        $post_id = $comment_to_delete->post_id;
        $parent_id = $comment_to_delete->parent_id;
        // $comment_to_delete->delete();
        broadcast(new CommentsEvent($post_id, $parent_id));
        // $this->dispatch('tyst', ['parent_id' => $parent_id, 'id_to_delete' => $comment_id]);
    }

    #[On('tyst')]
    public function tyst($payload)
    {
        if ($this->comment['id'] === $payload['id_to_delete']) {
            // $this->nested_comments = [];
            $del_id = $payload['id_to_delete'];
            ModelsComment::find($del_id)->delete();
        }
        if ($this->comment['id'] === $payload['parent_id']) {
            $children =  ModelsComment::find($payload['parent_id'])->children;
            $this->nested_comments = $children->filter(fn($comment) => $comment->id !== $payload['id_to_delete']);
            $this->nested_comments_counter = $this->nested_comments->count();
        }
    }

    public function edit() {}

    public function react($reaction)
    {
        if (!auth()->user()):
            redirect()->route('login');
        else:
            $data = [
                'reactable_id' => $this->comment['id'],
                'reactable_type' => 'App\Models\Comment',
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


            if ($reaction_obj = React::where('user_id', auth()->user()->id)->where('reactable_id', $this->comment['id'])->first()) {

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
            broadcast(new ReactsEvent())->toOthers();
        endif;
    }

    //for nested comments
    public function nested_comment()
    {
        try {
            $this->validate(['comment_body' => 'required']);
            // dump($this->post_id);
            $nested = ModelsComment::create([
                'user_id' => Auth::id(),
                'body' => $this->comment_body,
                'parent_id' => $this->parent_id,
            ]);
            // broadcast(new CommentsEvent())->toOthers();
            // $this->dispatch('render-nested-comments', ['parent_id' => $this->parent_id]);
            $this->reset('comment_body');
            broadcast(new CommentsEvent(null, $this->parent_id));
        } catch (Exception $e) {
            $this->dispatch('show-toast', err: 'Cannot submit an empty commnet!');
        }
    }

    /**
     * issue : queries is multiplied by 2 for every nested of nested comments
     * problem : can't delete nested comments
     * */
    #[On(['render-nested-comments', 'echo:comments-channel,CommentsEvent'])]
    public function render_nested_comments($payload)
    {
        if ($this->comment['id'] === $payload['parent_id']) {
            $this->nested_comments = ModelsComment::findOrFail($this->comment['id'])->children;
            $this->nested_comments_counter = $this->nested_comments->count();
        }
    }
    public function render()
    {
        return view('livewire.post.comment');
    }
}
