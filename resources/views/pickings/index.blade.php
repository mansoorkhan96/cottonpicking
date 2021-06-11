<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ 'Farmer '.$pickingnumber['farmer']['name'] . ' | ' .$pickingnumber['title'] }}
        </h2>
    </x-slot>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ 'Farmer '.$pickingnumber['farmer']['name'] . ' | ' .$pickingnumber['title'] }}
                        <button id="add_new_picking" data-toggle="modal" data-target="#exampleModal" class="text-white btn btn-sm btn-info float-right">Add New</button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="myTable" class="table table-bordered table-hover">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    @foreach ($picking_dates as $date => $daily_total)
                                        <th style="font-size: 11px">
                                            {{ $date }}
                                            <a href="{{ route('pickings.edit', request()->id) . '?date=' . $date }}" style="padding: 0rem 0.2rem" class="btn btn-info btn-sm text-white d-inline-block"><i class="fas fa-pencil-alt"></i></a>
                                        </th>
                                    @endforeach

                                    <th>Total</th>
                                    <th>Labour Payment</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pickings as $key => $item)
                                    <tr>
                                        <td>
                                            {{ $item->name }}
                                        </td>

                                        @php $labour_total = 0; @endphp
                                        @foreach ($picking_dates as $date => $daily_total)
                                            @php $labour_total += $item->$date; @endphp
                                            <td>{{ toMann($item->$date) }}</td>
                                        @endforeach
                                        <th>{{ toMann($labour_total) }}</th>
                                        <th>Rs {{ number_format($labour_total * $pickingnumber['labour_pay_per_kg'] ?? 0, 2) }}</th>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <th>Total</th>
                                @php $picking_number_total = 0; @endphp
                                @foreach ($picking_dates as $date => $daily_total)
                                    @php $picking_number_total += $daily_total; @endphp
                                    <th>{{ toMann($daily_total) }}</th>
                                @endforeach
                                <th>{{ toMann($picking_number_total) }}</th>
                                <th>Rs {{ number_format($picking_number_total * $pickingnumber['labour_pay_per_kg'] ?? 0, 2) }}</th>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Picking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="new_picking_form" action="{{ route('pickings.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="pickingnumber_id" value="{{ request()->id }}">

                    <div class="form-group">
                        <input type="date" class="form-control" name="date" value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    </div>
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <th width="50%">Name</th>
                                <th width="50%">KGs Picked</th>
                            </tr>
                        </thead>
                        <tbody id="labours">
                            @foreach ($current_picking_labour as $item)
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="p-1">
                                    <div class="form-group mb-0">
                                        <input style="width: 84%" type="number" min="0" step=".01" class="form-control kgs_picked" name="kgs_picked[{{ $item->labour_id }}]" required>
                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            @foreach ($other_labour as $item)
                            <tr class="new_labour" style="display: none" id="labour_{{ $item['id'] }}">
                                <td>{{ $item['name'] }}</td>
                                <td class="p-1">
                                    <div class="form-group mb-0">
                                        <input
                                            style="width: 84%"
                                            type="number"
                                            min="0"
                                            step=".01"
                                            class="form-control d-inline-block new_labour_kgs_picked"
                                            disabled
                                            name="kgs_picked[{{ $item['id'] }}]"
                                            required
                                        />

                                        <button type="button" class="btn btn-success btn-sm select_labour">
                                            <i class="fas fa-check"></i>
                                        </button>

                                        <button style="display: none !important" type="button" class="btn btn-danger btn-sm deselect_labour">
                                            <i class="far fa-times-circle"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <div>
                    @if(count($other_labour) > 0)
                        <button id="add_new_labour" type="button" data-toggle="modal" data-target="#newLabourModal" class="btn btn-primary btn-sm">Add Labour</button>
                    @endif

                    <p class="d-inline-block"> Want to register a new labour? <a href="{{ route('labours.create') }}">Click Here</a></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button form="new_picking_form" type="submit" class="btn btn-success">Save Picking</button>
            </div>
            </div>
        </div>
    </div>


    @push('scripts')
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
    @endpush
</x-app-layout>