<x-template>
  <div class="container">
    <div class="mb-3 text-end">
      <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn
btn-info">Ubah</a>
      <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">Hapus</button>
      <a href="{{ route('article.list') }}" class="btn
btn-secondary">Kembali</a>
    </div>

    <div class="badge text-bg-light">
      {{ $article->category->name }}
    </div>

    <h1>{{ $article->title }}</h1>
    <h5 class="mb-2 text-body-secondary">{{ $article->updated_at }}</h5>
    <p>
      {{ $article->content }}
    </p>

    <div class="accordion mt-5" id="accordionComment">
      <div class="accordion-item">
        <h2 class="accordion-header">
          <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne"
            aria-expanded="true" aria-controls="collapseOne">
            {{ $article->comments_count }} Komentar
          </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionComment">
          <div class="accordion-body">
            @foreach ($article->comments as $comment)
              <x-article-comment :comment="$comment"></x-article-comment>
            @endforeach
            <form method="post" action="{{ route('article.comment', ['id' => $article->id]) }}">
              @csrf
              <x-form.group for="comment" label="Tinggalkan komentar Anda">
                <textarea class="form-control" name="comment" id="comment"></textarea>
              </x-form.group>
              <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>

  <x-confirm-modal id="deleteModal" title="Hapus artikel" action="{{ route('article.delete', ['id' => $article->id]) }}"
    message="Apakah Anda yakin akan menghapus artikel?" />
</x-template>