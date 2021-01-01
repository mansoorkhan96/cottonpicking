@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ 'Farmer '.$pickingnumber['farmer']['name'] . ' | ' .$pickingnumber['season']['name'] . ' | '.$pickingnumber['title'] }}
                    <a href="{{ route('pickings.create') }}" class="text-white btn btn-sm btn-info float-right">Add New</a>
                </div>

                <div class="card-body table-responsive">
                    <table id="myTable" class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th>Name</th>
                                @foreach ($picking_dates as $date => $daily_total)
                                    <th>{{ $date }}</th>
                                @endforeach
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
                            <th>{{ $picking_number_total }}</th>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
