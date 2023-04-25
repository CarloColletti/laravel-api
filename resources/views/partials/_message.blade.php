<div class="row pt-3">
  @if (session('message_content'))
    <div class="alert alert-{{ session('message_type') ? session('message_type') : 'success'  }}">
      {{ session('message_content') }}
    </div>
  @endif
</div>