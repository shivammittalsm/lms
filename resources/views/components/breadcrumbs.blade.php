<nav aria-label="breadcrumb">
    <ol class="breadcrumb mb-0 bg-light">
      <li class="breadcrumb-item"><a href="{{url('/home')}}">
          <span>Dashboard</span>
        </a>
      </li>
      @isset($links)
        @foreach($links as $label => $url)
          <li class="breadcrumb-item">
            <a class="text-capitalize" href="{{$url}}">{{$label}}</a>
          </li>
        @endforeach
      @endisset
      <li class="breadcrumb-item active" aria-current="page">{{ $slot }}</li>
    </ol>
  </nav>
