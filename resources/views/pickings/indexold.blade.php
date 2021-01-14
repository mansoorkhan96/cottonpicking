@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Farmer '.$pickingnumber['farmer']['name'] . ' | ' .$pickingnumber['season']['name'] . ' | '.$pickingnumber['title'] }}
                    <button id="add_new_picking" class="text-white btn btn-sm btn-info float-right">Add New</button>
                </div>

                <div class="card-body table-responsive">
                    <form action="{{ route('pickings.store') }}" method="POST">
                    @csrf
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                @foreach ($picking_dates as $date => $daily_total)
                                    <th>{{ $date }}</th>
                                @endforeach
                                <td class="new_picking" style="display: none">
                                    <input type="hidden" name="pickingnumber_id" value="{{ request()->id }}">
                                    <input required type="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" name="date" id="" class="form-control">
                                </td>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $daily_total = 0; @endphp
                            @foreach ($pickings_by_labour as $key => $item)
                            @php

                            @endphp
                                <tr>
                                    <td>
                                        {{ $item[0]['labour']['name'] }}
                                    </td>

                                    @php $labour_total = 0; @endphp

                                    @foreach ($item as $index => $value)
                                    @php $labour_total += $value['kgs_picked']; @endphp
                                        <td>
                                            {{ $value['kgs_picked'] }}
                                        </td>
                                    @endforeach
                                    <td class="new_picking" style="display: none; width:10%">
                                        <input type="number" class="form-control" name="kgs_picked[{{ $item[0]['labour_id'] }}]">
                                    </td>
                                    <th>{{ $labour_total }}</th>
                                </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <th>Total</th>
                            @php $picking_number_total = 0; @endphp
                            @foreach ($picking_dates as $date => $daily_total)
                                @php $picking_number_total += $daily_total; @endphp
                                <th>{{ $daily_total }}</th>
                            @endforeach
                            <td class="text-center new_picking" style="display: none">
                                <button type="submit" class="btn btn-sm btn-info text-white">
                                    Submit
                                </button>
                            </td>
                            <th>{{ $picking_number_total }}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('#add_new_picking').click(function() {
                $('.new_picking').toggle();
                if($(this).text() === 'Add New') {
                    $(this).text('Cancel Add New')
                } else {
                    $(this).text('Add New')
                }
            })
        })
    </script>
@endsection