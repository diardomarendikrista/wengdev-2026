<x-template>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($articles->count() < 10)
            <a class="btn btn-success" href="{{ route('article.create') }}">Tambah
                artikel</a>
        @endif
        @foreach($articles as $article)
            <div class="card mt-3">
                <div class="card-body">
                    <a href="{{ route('article.single', ['slug' => $article->slug]) }}">
                        <h5 class="card-title">{{ $article->title }}</h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{ $article->updated_at }}</h6>
                    <p class="card-text">
                        {{ $article->content }}
                    </p>
                    <div class="badge text-bg-light">
                        {{ $article->category->name }}
                    </div>
                    <div class="mt-3">
                        @if($article->comments_count > 0)
                            <div class="mb-2 text-muted">Komentar terakhir</div>
                            <x-article-comment :comment="$article->comments->last()"></x-article-comment>
                        @endif
                        <a href="{{ route('article.single', ['slug' => $article->slug])  }}#comment">Lihat
                            {{ $article->comments_count }} komentar</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-template>