<a title="click again to make it favouit" class="{{$model->is_favorite ?'fav-ans':''}} mt-5"
   onclick="event.preventDefault(); document.getElementById('favorite-id-{{$model->id}}').submit()"
  >
    <i class="fas fa-star fa-2x"></i><br>
  <span class="favorites-count" >{{$model->favorite_count}}</span>
</a>
<form id="favorite-id-{{$model->id}}" method="POST" action="/question/{{$model->id}}/favorites">
  @if($model->is_favorite)
  @method('DELETE')
  @endif
  @csrf
</form> 