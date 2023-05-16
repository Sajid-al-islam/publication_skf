<ul id="menu-main-menu-1" class="menu">
    <li class="menu-item">
        <a href="/">
            <span class="menu-label-level-0">হোম</span>
        </a>
    </li>
    @foreach ($categories as $item)
    <li class="menu-item">
        <a href="{{ route('category_product') }}">
            <span class="menu-label-level-0"> {{$item->name}} </span>
        </a>
        @if (count($item->child))
        <div class="sub-menu">
            <ul>
                @foreach ($item->child as $child)
                <li>
                    <a href="#"> {{$child->name}} </a>
                </li>
                @endforeach
            </ul>
        </div>
        @endif
    </li>
    @endforeach

</ul>
