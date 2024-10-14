<?php

namespace App\Livewire\Post;

use App\Models\Comment as ModelsComment;
use App\Models\React;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use LogicException;

class Comment extends Component
{
    public $comment;
    public $owner;
    public $reacts;
    public $since;
    public $comment_body; //for nested comments

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

    public function delete()
    {
        $this->authorize('update-delete-comment', [Auth::id(), $this->comment['user_id']]);
        ModelsComment::find($this->comment['id'])->delete();
        $this->dispatch('delete-comment');
    }

    public function edit() {}

    public function react($reaction)
    {

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
    }
    public function render()
    {
        return view('livewire.post.comment');
    }
}
