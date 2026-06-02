@props(['id', 'title', 'action', 'message'])

<x-modal :id="$id" :title="$title" theme="text-bg-danger" :action="$action">
  {{ $message ?? $slot }}

  <x-slot name="footer">
    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
    <button type="submit" class="btn btn-primary">Hapus</button>
  </x-slot>
</x-modal>