@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Seasons') }}
                    <a href="{{ route('seasons.create') }}" class="text-white btn btn-info float-right">Add New</a>
                </div>

                <div class="card-body">
                    <table class="table table-light">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                <th>From-To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($seasons as $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>{{ $item['from_to'] }}</td>
                                <td>
                                    <a href="{{ route('seasons.edit', $item['id']) }}" class="text-white btn btn-info btn-sm">Edit</a>
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
