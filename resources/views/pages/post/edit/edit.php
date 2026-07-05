<?php

use App\Models\Post;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('Edit Post')] class extends Component
{
    public Post $post;

    public string $title;

    public string $text;

    public function mount(Post $post)
    {
        $this->authorize('update', $post);

        $this->post = $post;

        $this->title = $post->title;

        $this->text = $post->text;
    }

    public function save()
    {
        $this->authorize('update', $this->post);

        $this->post->title = $this->title;
        $this->post->text = $this->text;
        $this->post->save();

        Flux::toast(
            variant: 'success',
            text: 'Post has been updated',
        );
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
