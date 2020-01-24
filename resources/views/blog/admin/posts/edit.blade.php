@extends('layouts.app')

@section('content')
    @php /** @var \App\Models\BlogCategory $item */ @endphp
        <div class="container">
            @php /** @var \Illuminate\Support\ViewErrorBag $errors */ @endphp

            @include('blog.admin.posts.includes.result_messages')

            @if($item->exists)
                <form action="{{ route('blog.admin.posts.update', $item->id) }}" method="POST">
                    @method('PATCH')
            @else
                 <form action="{{ route('blog.admin.posts.store') }}" method="POST">
            @endif
            @csrf
            <div class="row justify-content-center">
                    <div class="col-md-8">
                        @include('blog.admin.posts.includes.item_edit_main_col')
                    </div>
                    <div class="col-md-3">
                        @include('blog.admin.posts.includes.item_edit_add_col')
                    </div>
            </div>
            </form>

            @if($item->exists)
                            <br>
                <form action="{{ route('blog.admin.posts.destroy',$item->id) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <div class="row justify-content-center">
                        <div class="col-md-8">
                            <div class="card card-bloc">
                                <button type="submit" class="btn btn-link">Удалить</button>
                            </div>
                        </div>
                        <div class="col-md-3"></div>
                    </div>
                </form>
            @endif
        </div>
@endsection