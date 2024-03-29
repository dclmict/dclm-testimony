@extends('Admin.layout.main')
{{-- @push('dataTableCss')
    <link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush --}}

@section('Admincontent')
    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Testimonies Table</h6> <br /> <span> You are currently viewing
                testimonies for the crusade: <span class="text-success">{{ $active_crusade->slug }} </span> </span>

        </div>
        @if ($testimonies->count() > 0)
            <div class="card-body">


                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                {{-- <th>Country</th> --}}
                                <th>Content</th>
                                <th>File</th>
                                <th>Time</th>
                                <th> Action</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Full Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>City</th>
                                {{-- <th>Country</th> --}}
                                <th>Content</th>
                                <th>File</th>
                                <th>Time</th>
                                <th> Action</th>
                            </tr>
                        </tfoot>
                        <tbody>

                            @foreach ($testimonies as $testimony)
                                <tr>

                                    <td>{{ $testimony->testifier->full_name }}</td>
                                    <td>{{ $testimony->testifier->email }}</td>
                                    <td>{{ $testimony->testifier->phone }}</td>
                                    <td>{{ $testimony->testifier->city }}</td>
                                    {{-- <td>{{ $testimony->country->code }}</td> --}}
                                    {{-- <td>{{ $testimony->country->libelle }}</td> --}}
                                    <td>{{ substr($testimony->content, 0, 20) }}...</td>
                                    <td><a href="{{ $testimony->path }}"
                                            target="_blank">{{ $testimony->path ? 'Media file' : 'No Media file' }}</a>
                                    </td>

                                    <td>{{ $testimony->created_at->format('d/m/Y') }} <br>
                                        {{ $testimony->created_at->addMinute()->addSecond()->diffForHumans(null, true, false, 2) }}
                                    </td>
                                    <td>


                                        <a href="{{ route('admin.testimonies.show', $testimony->id) }}"
                                            class="btn btn-sm btn-white text-primary mr-2"><i class="far fa-eye mr-1"></i>
                                            View</a>

                                        <form method="post"
                                            action="{{ route('admin.testimonies.delete', $testimony->id) }}">

                                            @method('DELETE')
                                            @csrf()
                                            <button class="btn btn-sm btn-white text-danger mr-2"
                                                onclick="return confirm('Warning! This is a dangerous action. Are you sure about this ? ');"><i
                                                    class="far fa-trash-alt mr-1"></i>Delete</button>
                                        </form>


                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @else
            <h4> There are no testimonies available at the moment please <a
                    href="{{ route('admin.testimony.vetted.create') }}"> add here</a></h4>
        @endif
    </div>
@endsection

@push('dataTableScripts')
    <!-- Page level plugins -->
    <script src=" {{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src=" {{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>
@endpush
