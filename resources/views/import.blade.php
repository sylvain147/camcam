@extends('app')
@section('content')
    <div class="flex flex-col space-y-4">

        <div class="flex justify-end">
            <form action="{{route('import.file')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button>importer</button>
            </form>

        </div>

        <div class="flex justify-end">
            <form action="{{route('import.ids')}}" method="post" enctype="multipart/form-data">
                @csrf
                <input type="file" name="file">
                <button>importer ids</button>
            </form>

        </div>
    </div>
@endsection