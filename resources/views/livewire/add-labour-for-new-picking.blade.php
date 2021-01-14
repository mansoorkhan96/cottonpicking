<div>
    {{-- TODO: make single component for picking labour and new labour  --}}
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
                <form action="{{ route('pickings.store') }}" method="POST">
                    @csrf

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
                            @foreach ($labour as $item)
                            @if(isset($item->name))
                            <tr>
                                <td>{{ $item->name }}</td>
                                <td class="p-1">
                                    <div class="form-group mb-0">
                                        <input type="number" class="form-control" name="kgs_picked[{{ $item->labour_id }}]" required>
                                    </div>
                                </td>
                            </tr>
                            @else
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td class="p-1">
                                    <div class="form-group mb-0">
                                        <input type="number" class="form-control" name="kgs_picked[{{ $item->labour_id }}]" required>
                                    </div>
                                </td>
                            </tr>
                            @endif
                            @endforeach
                        </tbody>
                    </table>
                </form>
                <button type="button" data-toggle="modal" data-target="#newLabourModal" class="btn btn-primary btn-sm">Add new Labour</button>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="newLabourModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Labour</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="form-group mb-0">
                        {{-- {!! Form::select('new_labour[]', $other_labour, null, ['class' => 'form-control', 'required']) !!} --}}
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add Labour</button>
            </div>
            </div>
        </div>
    </div>
</div>
