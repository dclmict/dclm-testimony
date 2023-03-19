@extends('Admin.layout.main')
@section('content')
    <h1 class="h3 mb-4 text-gray-800">View Crusade Tours</h1>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    {{-- table --}}
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Banner</th>
                                <th>slug</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($crusadeTours as $crusadeTour)
                                <tr>
                                    <td>{{ $crusadeTour->id }}</td>
                                    <td><img width="100" src="{{$crusadeTour->banner}}" alt="Banner"></td>
                                    <td>{{ $crusadeTour->slug }}</td>
                                    <td>{{$crusadeTour->name}}</td>
                                    <td class="d-flex flex-wrap justify-content-between ">
                                        <a href="{{ route('admin.crusade.tour.active', $crusadeTour->id) }}"
                                            class="btn btn-{{ $crusadeTour->is_active ? 'success' : 'primary' }} btn-sm">
                                            {{ $crusadeTour->is_active ? 'Ongoing' : 'Activate' }}</a>
                                        <a href="{{ route('admin.crusade.tour.edit', $crusadeTour->id) }}"
                                            class="btn btn-primary btn-sm">Edit</a>

                                        <a target="_blank" class="btn btn-secondary btn-sm"
                                            href="{{ route('admin.crusade.tour.exportPdf', $crusadeTour->id) }}"> Export
                                            Testimonies</a>
                                        <a href="{{ route('admin.crusade.tour.delete', $crusadeTour->id) }}"
                                            class="btn btn-danger btn-sm mt-1">Delete
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{-- end table --}}
                </div>
            </div>
        </div>
    </div>
@endsection
