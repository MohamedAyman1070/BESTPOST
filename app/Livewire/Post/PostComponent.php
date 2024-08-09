<?php

namespace App\Livewire\Post;

use App\Livewire\Profile\Post;
use App\Models\Post as ModelsPost;
use Carbon\Carbon;
use DateTime;
use Livewire\Component;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PostComponent extends Component
{

    public $post ;
    public $since;

    public function mount(){

        
        $this->post['body']= explode("\n" , $this->post['body']);
        
        $this->since = Carbon::now() ;
        $post_dt  = new Carbon($this->post['created_at']);
        $this->since = $post_dt->diffForHumans($this->since);
        $this->since = str_replace('before' , 'ago' , $this->since);
    }

    public function follow(){
        
    }

    public function delete($postID){// Issue # DOM not not rendered immediately after deletion
        $post = ModelsPost::find($postID);
        if($post):
        $this->authorize('update-delete-post', $post['user_id']);
        $post->delete();
        $this->post = null;
        else:
            return throw new NotFoundHttpException();
        endif;
     }


    public function render()
    {
        return view('livewire.post.post-component');
    }
}
