<div class="mb-3 d-flex">
  <img class="border rounded-circle me-3 bg-light" src="" alt="Profile picture pengirim" style="width:3em; height:3em">
  <div class="card flex-grow-1 text-bg-light border-0">
    <div class="card-body">
      <div class="d-flex justify-content-between align-items-center mb-1">
        <div class="text-secondary">
          {{ Date::parse($comment->created_at)->locale('id')->diffForHumans()  }}
        </div>
        <button type="button" class="btn btn-sm btn-outline-danger py-0 px-2 border-0" title="Hapus Komentar"
          data-bs-toggle="modal" data-bs-target="#deleteCommentModal-{{ $comment->id }}">
          &times;
        </button>
        <x-confirm-modal id="deleteCommentModal-{{ $comment->id }}" title="Hapus komentar"
          action="{{ route('article.comment.delete', ['id' => $comment->id]) }}"
          message="Apakah Anda yakin akan menghapus komentar ini?" />
      </div>
      {{ $comment->content }}
    </div>
  </div>
</div>