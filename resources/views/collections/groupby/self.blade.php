<h2 class="d-block text-transparent bg-clip-text bg-gradient-to-r to-emerald-600 from-sky-400 text-xl font-bold">Self Posts</h2>
@foreach ($children as $post)
  <div class="row pb-3">
    <div class="col-12 text-white">
      <p>{!! html_entity_decode($post['data']['selftext_html']) !!}</p>
    </div>
  </div>
@endforeach
