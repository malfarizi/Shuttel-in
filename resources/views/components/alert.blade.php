@if($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <strong>{{ $message }}</strong>
        <button 
            type="button" 
            class="close text-white" 
            data-dismiss="alert"
            aria-label="Close"
        >
            <span aria-hidden="true"> &times; </span>
        </button>    
    </div>
@endif

@if($message = session('error') || $errors->any())
    <div class="alert alert-danger alert-dismissible fade show">
        @if($message)
            <strong>{{ $message }}</strong>
        @else
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif

        <button 
            type="button" 
            class="close text-white" 
            data-dismiss="alert"
            aria-label="Close"
        >
            <span aria-hidden="true"> &times; </span>
        </button>    
    </div>
@endif