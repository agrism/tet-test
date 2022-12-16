@extends('layouts.app')

@section('title', 'Currencies')


@section('content')
    <div class="card">
        <div class="card-header">
            Currencies
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-3">
                    <form>
                        @include('partials.select', ['label'=>'Currency','options' => $currencies, 'key'=> 'currency'])
                        @include('partials.select', ['label'=>'Date','options' => $dates, 'key'=> 'date'])
                        <div class="form-group col-12">
                            <button class="btn btn-primary">Filter</button>
                        </div>
                    </form>
                </div>
                <div class="col-lg-9">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Currency</th>
                            <th scope="col">Rate</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($rates as $rate)
                            <tr>
                                <td>{{$rate->date}}</td>
                                <td>{{$rate->currency}}</td>
                                <td>{{$rate->rate}}</td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{ $rates->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
