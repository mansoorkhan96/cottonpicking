@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Farmers') }}
                    <a href="{{ route('farmers.create') }}" class="text-white btn btn-info float-right">Add New</a>
                </div>

                <div class="card-body">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($farmers as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <a href="{{ route('farmers.edit', $item['id']) }}" class="text-white btn btn-info btn-sm">Edit</a>
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
@endsection
