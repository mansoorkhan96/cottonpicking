@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Edit Picking') }} for [{{ $date }}]</div>

                <div class="card-body">
                    <form id="new_picking_form" action="{{ route('pickings.update', $pickingnumber_id) }}" method="POST">
                        @csrf
                        @method('put')
                        <input type="hidden" name="date" value="{{ $date }}">

                        <table class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th width="50%">Name</th>
                                    <th width="50%">KGs Picked</th>
                                </tr>
                            </thead>
                            <tbody id="labours">
                                @foreach ($pickings as $item)
                                <tr>
                                    <td>{{ $item->name }}</td>
                                    <td class="p-1">
                                        <div class="form-group mb-0">
                                            <input style="width: 84%" type="number" class="form-control kgs_picked" value="{{ $item->kgs_picked }}" name="kgs_picked[{{ $item->labour_id }}]" required>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

                                @foreach ($other_labour as $item)
                                <tr class="new_labour" style="display: none" id="labour_{{ $item['id'] }}">
                                    <td>{{ $item['name'] }}</td>
                                    <td class="p-1">
                                        <div class="form-group mb-0">
                                            <input style="width: 84%" type="number" class="form-control d-inline-block new_labour_kgs_picked" disabled name="kgs_picked[{{ $item['id'] }}]" required>
                                            <button type="button" class="btn btn-success btn-sm select_labour"><i class="fas fa-check"></i></button>
                                            <button style="display: none !important" type="button" class="btn btn-danger btn-sm deselect_labour"><i class="far fa-times-circle"></i></i></button>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </form>
                    @if(count($other_labour) > 0)
                    <div>
                        <button id="add_new_labour" type="button" data-toggle="modal" data-target="#newLabourModal" class="btn btn-primary btn-sm">Add Labour</button>
                        <p class="d-inline-block"> Want to register a new labour? <a href="{{ route('labours.create') }}">Click Here</a></p>
                    </div>
                    @endif

                    <div class="form-group mb-0 text-right">
                        <button type="submit" form="new_picking_form" class="btn btn-success">
                            {{ __('Save Picking') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#add_new_labour').click(function() {
                $('.new_labour').show()
                $(this).hide()
            })

            $('.select_labour').click(function() {
                $(this).siblings('.deselect_labour').show()
                $(this).siblings('.new_labour_kgs_picked').attr('disabled', false)

                $(this).hide()
            })

            $('.deselect_labour').click(function() {
                $(this).siblings('.select_labour').show()
                $(this).siblings('.new_labour_kgs_picked').attr('disabled', true)

                $(this).hide()
            })
        })
    </script>
@endsection
