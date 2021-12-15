@extends('app')
@section('content')
    <div class="flex justify-end">
        <form action="{{route('import.file')}}" method="post" enctype="multipart/form-data">
            @csrf
        <input type="file" name="file">
        <button>importer</button>
        </form>

    </div>
@endsection