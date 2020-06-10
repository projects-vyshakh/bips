@foreach($childs as $child)
    <li class="">
        <a href="{{$child->url}}" class="waves-effect">
            <i class="{{$child->icon}}"></i>
            <span class="badge badge-success badge-pill float-right"></span>
            <span>{{ $child->title }}</span>
        </a>
        @if(count($child->childs))
            <ul class="nav-second-level" aria-expanded="false">
                @include('menu.menusub',['childs' => $menu->childs])
            </ul>
        @endif
    </li>
@endforeach
