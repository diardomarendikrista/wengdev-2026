<x-template>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        @if ($articles->count() < 10)
            <a class="btn btn-success" href="{{ route('articles.create') }}">Tambah
                artikel</a>
        @endif
        @foreach($articles as $article)
            <div class="card mt-3">
                <div class="card-body">
                    <a href="{{ route('articles.single', ['slug' => $article->slug]) }}">
                        <h5 class="card-title">{{ $article->title }}</h5>
                    </a>
                    <h6 class="card-subtitle mb-2 text-body-secondary">{{
            $article->updated_at }}</h6>
                    <p class="card-text">
                        {{ $article->content }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</x-template>