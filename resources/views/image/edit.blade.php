@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Editar imágen
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('image.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="image_id" value="{{ $image->id }}">
                        <div class="form group row mt-3">
                            <label for="image_path" class="col-md-3 col-form-label text-md-right">Imágen</label>
                            <div class="col-md-7">
                                @if(optional($image->user)->image)
                                    <div class="container-avatar">
                                        <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" class="avatar"/>
                                    </div>
                                @endif
                                <input id="image_path" type="file" name="image_path" class="form-control  {{$errors->has('image_path') ? 'is-invalid' : ''}}">
                                @if($errors->has('image_path'))
                                    <spam class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('image_path') }}</strong>
                                    </spam>
                                @endif
                            </div>
                        </div>

                        <div class="form group row mt-3">
                            <label for="description" class="col-md-3 col-form-label text-md-right">Descripción</label>
                            <div class="col-md-7">
                                <textarea id="description" name="description" class="form-control  {{$errors->has('description') ? 'is-invalid' : ''}}" required>{{$image->description}}
                                </textarea>
                                @if($errors->has('description'))
                                    <spam class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </spam>
                                @endif
                            </div>
                        </div>

                        <div class="form group row mt-3">
                            <div class="col-md-6 offset-md-3">
                                <input type="submit" class="btn btn-primary" value="Actualizar imágen">
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection