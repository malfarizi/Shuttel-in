@extends('admin.templates.index')

@section('content')
<div class="main-content">
    <section class="section">
        @include('components.breadcrumbs', ['menu' => 'Data Customer'])
        <div class="section-body">
            <!-- DataTable with Hover -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            @include('components.alert')
                            <div class="table-responsive">
                                <table class="table table-striped" id="table-1">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>E-mail</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>E-mail</th>
                                            <th>No Telepon</th>
                                            <th>Alamat</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        @forelse($customers as $customer)
                                            <tr>
                                                <td>{{ ++$i }}</td>
                                                <td>{{ $customer->name }}</td>
                                                <td>{{ $customer->email }}</td>
                                                <td>{{ $customer->phone_number }}</td>
                                                <td>{{ $customer->address }}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">
                                                    Belum ada data customer
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!--Row-->
            </div>
        </div>
    </section>
</div>
@endsection