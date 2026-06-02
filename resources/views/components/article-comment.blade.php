<div class="mb-3 d-flex">
  <img class="border rounded-circle me-3 bg-light" src="" alt="Profile picture pengirim" style="width:3em; height:3em">
  <div class="card flex-grow-1 text-bg-light border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="text-secondary">
          {{ Date::parse($comment->created_at)->locale('id')->diffForHumans()  }}
          @if($comment->updated_at != $comment->created_at)
            <small class="text-muted ms-1">(diubah
              {{ Date::parse($comment->updated_at)->locale('id')->diffForHumans() }})</small>
          @endif
        </div>
        <div>
          <button type="button" class="btn btn-sm btn-outline-primary py-0 px-2 border-0 me-1" title="Ubah Komentar"
            data-bs-toggle="modal" data-bs-target="#editCommentModal-{{ $comment->id }}">
            &#9998;
          </button>
          <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus Komentar"
            data-bs-toggle="modal" data-bs-target="#deleteCommentModal-{{ $comment->id }}">
            &times;
          </button>
        </div>
        <x-confirm-modal id="deleteCommentModal-{{ $comment->id }}" title="Hapus komentar"
          action="{{ route('article.comment.delete', ['id' => $comment->id]) }}"
          message="Apakah Anda yakin akan menghapus komentar ini?" />

        <x-modal id="editCommentModal-{{ $comment->id }}" title="Ubah komentar" theme="text-bg-primary"
          action="{{ route('article.comment.edit', ['id' => $comment->id]) }}">
          <div class="mb-3">
            <label for="content-{{ $comment->id }}" class="form-label">Isi Komentar</label>
            <textarea class="form-control" name="content" id="content-{{ $comment->id }}"
              rows="3">{{ $comment->content }}</textarea>
          </div>

          <x-slot name="footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
          </x-slot>
        </x-modal>
      </div>
      {{ $comment->content }}
    </div>
  </div>
</div>