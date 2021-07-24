@extends('_layouts/main')

@section('title','SquareOff')

@section('main-content')
<div class="wrapper">
    <h1>Square Off Admin Panel</h1>
    <div class="row align-items-center my-4" id="generated-variants">
                <table class="table" id="order-table">
                    <thead>
                        <tr>
                            <td>Name</td>
                            <td>MRP</td>
                            <td>Edit</td>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <td>{{ $order['name'] }}</td>
                                <td>{{ $order['mrp'] }}</td>
                                <td><a href="{{ route('admin', ['id' => $order['id']]) }}"> <i class="fa fa-edit"></i></a></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
</div>
@endsection

@section('page-scripts')
    <script>

    </script>
@endsection