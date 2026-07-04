<?php

use App\Models\Post;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Edit Post')] class extends Component
{
    public Post $post;

    public function mount(Post $post)
    {
        $this->authorize('update', $post);

        $this->post = $post;
    }

    public function delete()
    {
        $this->authorize('delete', $this->post);

        $this->post->delete();

        Flux::toast(
            variant: 'success',
            text: 'Post has been deleted',
        );

        $this->redirect('/dashboard', true);
    }
};
