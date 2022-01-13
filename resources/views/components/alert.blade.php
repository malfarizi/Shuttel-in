@if($message = session('success') ?? session('message'))
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

@if(session('error') || $errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        @if($message = session('error'))
            <strong>{{ $message }}</strong>
        @else
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <button 
            type="button" 
            @isset($isBootstrap5)
                class="btn-close" 
                data-bs-dismiss="alert"
            @else
                class="close text-white" 
                data-dismiss="alert"
            @endisset
            aria-label="Close"
        >
        @empty($isBootstrap5)
            <span aria-hidden="true"> &times; </span> 
        @endempty 
        </button>    
    </div>
@endif