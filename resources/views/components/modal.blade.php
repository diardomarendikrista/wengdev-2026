@props(['id', 'title', 'theme' => 'text-bg-primary', 'action' => null, 'method' => 'POST'])

<div class="modal fade" id="{{ $id }}" tabindex="-1" aria-labelledby="{{ $id }}Label" aria-hidden="true">
  <div class="modal-dialog">
    @if($action)
      <form method="{{ $method }}" action="{{ $action }}">
        @csrf
    @endif

      <div class="modal-content">
        <div class="modal-header {{ $theme }}">
          <h1 class="modal-title fs-5" id="{{ $id }}Label">{{ $title }}</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-start">
          {{ $slot }}
        </div>
        @if (isset($footer))
          <div class="modal-footer">
            {{ $footer }}
          </div>
        @endif
      </div>

      @if($action)
        </form>
      @endif
  </div>
</div>