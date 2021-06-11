<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Picking Numbers') }}
        </h2>
    </x-slot>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/jquery.dataTables.min.css') }}">
    @endpush

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Picking Numbers') }}
                        <a href="{{ route('pickingnumbers.create') }}" class="text-white btn btn-sm btn-info float-right">Add New</a>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="myTable" class="table table-light table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Farmer</th>
                                    <th>Title</th>
                                    <th>Sell Rate</th>
                                    <th>Labour Pay Rate</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pickingnumbers as $item)
                                <tr>
                                    <td>{{ $item['farmer']['name'] }}</td>
                                    <td>{{ $item['title'] }}</td>
                                    <td>{{ $item['sell_per_kg'] * 40 }}/Mann | {{ $item['sell_per_kg'] ?? 0 }}/Kg</td>
                                    <td>{{ $item['labour_pay_per_kg'] * 40 }}/Mann | {{ $item['labour_pay_per_kg'] }}/Kg</td>
                                    <td>
                                        <a href="{{ route('pickingnumbers.edit', $item['id']) }}" class="text-white btn btn-info btn-sm mb-1">Edit</a>
                                        <a href="{{ route('pickings.index', ['id' => $item['id']]) }}" class="text-white btn btn-info btn-sm mb-1">View Pickings</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>
        <script>
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
        </script>
    @endpush
</x-app-layout>
