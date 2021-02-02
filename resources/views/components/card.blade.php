<div class="card mt-4">
    <div class="card-body">
        <h4 class="card-title">{{$title}}</h4>
        <p class="text-muted">{{$text}}</p>
    </div>
    <ul class="list-group list-group-flush">
        @foreach ($items as $item)

         <li class="list-group-item">
            {{-- <span class="badge badge-info">{{$item->posts_count}}</span> --}}
             <a href="http://">{{$item}}</a>
         </li>

        @endforeach
    </ul>
</div>
