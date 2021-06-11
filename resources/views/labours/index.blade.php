<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Labours') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Labours') }}
                        <a href="{{ route('labours.create') }}" class="text-white btn btn-info float-right">Add New</a>
                    </div>

                    <div class="card-body">
                        <table class="table table-light">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Is Active</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($labours as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td>
                                        <livewire:update-is-active :user="$item" />
                                    </td>
                                    <td>
                                        <a href="{{ route('labours.edit', $item->id) }}" class="text-white btn btn-info btn-sm">Edit</a>
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
</x-app-layout>
