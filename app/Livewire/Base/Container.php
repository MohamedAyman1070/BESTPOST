<?php

namespace App\Livewire\Base;

use App\Models\Post;
use Livewire\Attributes\On;
use Livewire\Component;

class Container extends Component
{

    public const perPage = 10;
    public $page_n = 1;
    public $maxPages;
    public $postArrayChunks;
    public $posts;

    #[On('delete-post')]
    public function mount()
    {
        if ($this->posts) :
            $this->postArrayChunks = $this->posts->chunk(self::perPage)->toArray();
        else :
            $this->postArrayChunks  = Post::latest()->get()->chunk(self::perPage)->toArray();
        endif;
        $this->maxPages = count($this->postArrayChunks);
    }

    public function loadMore()
    {
        $this->page_n++;
    }

    public function hasMorePages()
    {
        return $this->page_n < $this->maxPages;
    }

    
    public function render()
    {
        return view('livewire.base.container');
    }
}
