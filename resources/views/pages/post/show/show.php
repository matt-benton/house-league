<?php

use App\Models\Post;
use Livewire\Component;

new class extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->authorize('view', $post);

        $this->post = $post;
    }

    public function render()
    {
        return $this->view()
            ->title($this->post->title);
    }
};
