<div>

    <div class="text-xl w-full text-blue-500 font-bold text-center p-2 animate-pulse   " wire:loading>
        Loading...
    </div>
    @if ($postArrayChunks)
        @for ($i = 0; $i < $page_n; $i++)
            @foreach ($postArrayChunks[$i] as $post)
                <livewire:post.PostComponent :$post :key="$post['id']">
            @endforeach
        @endfor
    @else
        <div class="text-xl text-gray-300 h-96 flex justify-center items-center">
            ⚠️ No posts yet!!
        </div>
    @endif
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


    <div class="text-xl text-blue-500 font-bold text-center p-2 animate-pulse  " wire:loading>
        Loading...
    </div>



</div>
