@extends('customer.template')

@section('content')

<!-- ======= riwayat Section ======= -->
<section id="jadwal" class="jadwal">

    <div class="container mt-5" data-aos="fade-up">
        <div class="box">
            <table class=" table table-responsive table-borderless">
                <thead c>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Invoice</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Invoice</td>
                        <td>Badge Component</td>
                        <td>
                            <button type="button" class="btn btn-sm btn-success btn-icon"><i
                                    class="bi bi-eye"></i></button>
                            <button type="button" class="btn btn-sm btn-primary btn-icon"><i
                                    class="bi bi-printer"></i></button>
                            <button type="button" class="btn btn-sm btn-warning btn-icon"><i class="bi bi-cash"></i>
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</section><!-- End Pricing Section -->
@endsection