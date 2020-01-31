@extends('layouts.app')

@section('content')
    <div class="card p-5">
        <div class="table-responsive">
            <table class="table">
                @foreach($items as $item)
                    <tr>
                        <td>{{$item->id}}</td>
                        <td>{{$item->title}}</td>
                        <td>{{$item->created_at}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection

