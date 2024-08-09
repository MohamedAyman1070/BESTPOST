<div>


    @for ($i = 0; $i < $page_n; $i++)
        @foreach ($postArrayChunks[$i] as $post)
            <livewire:post.PostComponent :$post :key="$post['id']">
        @endforeach
    @endfor

    @if ($this->hasMorePages())
        <div x-data="{
            observe() {
                let observer = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            @this.call('loadMore')
                        }
                    })
                }, {
                    root: null
                })
        
                observer.observe(this.$el)
            }
        }" x-init="observe"></div>
    @endif


    <div class="text-xl text-blue-500 font-bold text-center p-2 animate-pulse  " wire:loading >
        Loading...
    </div>



</div>
