<?php

use App\Models\League;
use App\Models\Post;
use Flux\Flux;
use Livewire\Attributes\Title;
use Livewire\Component;

new #[Title('New Post')] class extends Component
{
    public string $title;

    public string $text;

    public League $league;

    public function mount()
    {
        $this->league = League::find(session('league_id'));
    }

    public function publish()
    {
        $this->authorize('create', Post::class);

        $this->validate();

        $post = new Post;
        $post->title = $this->title;
        $post->text = $this->text;
        $post->user_id = auth()->id();
        $post->league_id = $this->league->id;
        $post->save();

        Flux::toast(
            variant: 'success',
            text: 'Post has been published',
        );

        $this->redirect("/posts/{$post->id}", true);
    }

    public function rules()
    {
        return [
            'title' => 'max:255',
            'text' => 'required',
        ];
    }
};
