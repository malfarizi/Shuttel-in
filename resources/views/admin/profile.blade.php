@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('components.breadcrumbs', ['menu' => 'Edit Profile'])

        <div class="section-body">
            <!-- DataTable with Hover -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                           <h2>Edit Profile</h2>
                        </div>
                        <form action="{{route('admin.profile.update', $user->id)}}" method="POST">
                            @csrf
                            @method('PUT')  
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input 
                                        type="text" 
                                        class="form-control @error('name') is-invalid @enderror" 
                                        name="name" 
                                        value="{{$user->name}}">
                                        
                                        @error('name')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone_number">No Telephone</label>
                                    <input 
                                        type="text" 
                                        class="form-control integerInput @error('phone_number') is-invalid @enderror" 
                                        name="phone_number" value="{{$user->phone_number}}">
                                        @error('phone_number')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror
                                </div>

                                <div class="form-group">
                                    <label for="address">Alamat</label>
                                    <textarea 
                                        class="form-control h-25 @error('address') is-invalid @enderror" 
                                        rows="5" 
                                        name="address"
                                    >{{$user->address}}</textarea>
                                    @error('address')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="text-center mb-5">
                                <button class="btn btn-primary" type="submit">
                                    Ubah Data
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.integerInput').on('input', function() {
                // numbers and decimals only
                this.value = this.value.replace(/[^\d]/g, '');
            });
        });
    </script>
@endpush
