<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 font-weight-bold">
            {{ __('Edit Picking Number') }}
        </h2>
    </x-slot>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit Picking Number') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('pickingnumbers.update', $pickingnumber->id) }}">
                            @csrf
                            @method('put')

                            <div class="form-group row">
                                <label for="farmer_id" class="col-md-4 col-form-label text-md-right">{{ __('Choose Farmer') }}</label>

                                <div class="col-md-6">
                                    {!! Form::select('farmer_id', $farmers, old('farmer_id') ?? $pickingnumber->farmer_id, ['class' => 'form-control']) !!}

                                    @error('farmer_id')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-md-4 col-form-label text-md-right">{{ __('Title') }}</label>

                                <div class="col-md-6">
                                    <input id="title" type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{ old('title')  ?? $pickingnumber->title }}" required autocomplete="title" autofocus>

                                    @error('title')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="sell_per_kg" class="col-md-4 col-form-label text-md-right">{{ __('Sell Rate/Kgs') }}</label>

                                <div class="col-md-6">
                                    <input id="sell_per_kg" type="text" class="form-control @error('sell_per_kg') is-invalid @enderror" name="sell_per_kg" value="{{ old('sell_per_kg') ?? $pickingnumber->sell_per_kg }}" placeholder="122.5" autocomplete="sell_per_kg" autofocus>

                                    @error('sell_per_kg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="labour_pay_per_kg" class="col-md-4 col-form-label text-md-right">{{ __('Labour Pay Rate/Kgs') }}</label>

                                <div class="col-md-6">
                                    <input id="labour_pay_per_kg" type="text" class="form-control @error('labour_pay_per_kg') is-invalid @enderror" name="labour_pay_per_kg" value="{{ old('labour_pay_per_kg') ?? $pickingnumber->labour_pay_per_kg }}" placeholder="12.5" required autocomplete="labour_pay_per_kg" autofocus>

                                    @error('labour_pay_per_kg')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
