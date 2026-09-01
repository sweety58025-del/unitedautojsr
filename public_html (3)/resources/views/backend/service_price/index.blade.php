@extends('backend.partial.master')
@section('main_title', 'Product')
@section('title', 'Service Price')

@section('backend-content')

<div class="card">
    <div class="card-header d-flex justify-content-between">
        <h4>Service Price List</h4>
        <a href="{{ route('service-price.create') }}" class="btn btn-primary">Add Service</a>
    </div>

    <div class="card-body">

        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Item</th>
                    <th>Small Car</th>
                    <th>Medium</th>
                    <th>SUV/MUV</th>
                    <th>Premium</th>
                    <th width="150">Action</th>
                </tr>
            </thead>

            <tbody>

                @foreach($services as $key => $service)

                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $service->item }}</td>
                    <td>{{ $service->small_car_price }}</td>
                    <td>{{ $service->medium_price }}</td>
                    <td>{{ $service->suv_muv_price }}</td>
                    <td>{{ $service->premium_price }}</td>

                    <td>

                        <a href="{{ route('service-price.edit',$service->id) }}" class="btn btn-warning btn-sm">Edit</a>

                        <form action="{{ route('service-price.destroy',$service->id) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')

                            <button onclick="return confirm('Delete this service?')" class="btn btn-danger btn-sm">
                                Delete
                            </button>

                        </form>

                    </td>
                </tr>

                @endforeach

            </tbody>

        </table>
        </div>

    </div>
</div>

@endsection