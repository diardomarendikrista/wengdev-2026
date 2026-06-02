<x-template>
    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        <a class="btn btn-success mb-3" href="{{ route('article.create') }}">Tambah artikel</a>

        <form action="{{ route('article.list') }}" method="GET" class="mb-3 mt-3 d-flex gap-2">
            <input type="text" name="search" class="form-control flex-grow-1"
                placeholder="Cari artikel dari judul atau konten..." value="{{ request('search') }}">
            <select name="sort" class="form-select w-auto">
                <option value="">Urutkan (Default)</option>
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>Nama A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Nama Z-A</option>
            </select>
            <button type="submit" class="btn btn-primary">Terapkan</button>
        </form>

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