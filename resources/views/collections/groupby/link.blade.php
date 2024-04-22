<h2 class="d-block text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 text-xl font-bold">Image Posts</h2>
@foreach ($children as $post)
  <div class="row pb-3">
    <div class="col-12">
      <img class="d-block mr-3" width="250" src="{{ $post['data']['thumbnail'] }}">
    </div>
  </div>
@endforeach
