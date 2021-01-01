<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <table class="table table-bordered">
        <thead>
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
</body>
</html>