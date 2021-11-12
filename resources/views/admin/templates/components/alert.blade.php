@if($message = session('success'))
    <div class="alert alert-success alert-dismissible fade show">
        <strong>Success</strong>
        <button 
            type="button" 
            class="close text-white" 
            data-dismiss="alert"
            aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>    
    </div>
@endif