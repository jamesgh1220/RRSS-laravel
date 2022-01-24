@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            @include('includes.message')
                <div class="card pub_image pub_image_detail">
                    <div class="card-header">
                        @if(optional($image->user)->image)
                            <div class="container-avatar">
                                <img src="{{ route('user.avatar', ['filename'=>$image->user->image])}}" class="avatar" />
                            </div>
                        @endif
                        <div class="data-user">
                            {{$image->user->name.' '.$image->user->surname}}
                            <span class="nickname">
                                {{ '@'.$image->user->nick }}
                            </span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="image-container image-detail">
                            <img src="{{ route('image.file', ['filename' => $image->image_path]) }}" />
                        </div>
                        <div class="likes">
                            <!--Comprobar si el usuario ya le dio like a la imagen-->
                            <?php $user_like = false; ?>
                            <!--image->likes es un array con los likes a cada imagen-->
                            @foreach($image->likes as $like)
                                @if($like->user->id == Auth::user()->id)
                                    <?php $user_like = true; ?>
                                @endif
                            @endforeach
                            @if($user_like)
                                <img src="{{asset('img/heart-red.png')}}" data-id="{{$image->id}}" class="btn-dislike" alt="">
                            @else
                                <img src="{{asset('img/heart-gray.png')}}" data-id="{{$image->id}}" class="btn-like" alt="">
                            @endif
                            <span class="number-likes">
                                {{count($image->likes)}}
                            </span>
                        </div>
                        <div class="description">
                            <span class="nickname">{{'@'.$image->user->nick}}</span>
                            <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($image->created_at) }}</span>
                            <p>{{$image->description }}</p>
                        </div>
                        @if(Auth::user() && Auth::user()->id == $image->user->id)
                            <div class="actions">
                                <a href="" class="btn btn-sm btn-warning">Actualizar</a>
                                <!--<a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-sm btn-danger">Borar</a>-->
                                <!-- Button to Open the Modal -->
                                    <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal">
                                    Eliminar
                                    </button>

                                    <!-- The Modal -->
                                    <div class="modal" id="myModal">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">¿Eliminar imágen?</h4>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>

                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            Si eliminas esta imágen, no podrás volver a recuperarla.
                                            ¿Quieres eliminarla?
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-dismiss="modal">Cancelar</button>
                                            <a href="{{ route('image.delete', ['id' => $image->id]) }}" class="btn btn-danger">Eliminar</a>
                                        </div>

                                        </div>
                                    </div>
                                    </div>
                            </div>
                        @endif
                        <div class="clearfix"></div>
                        <div class="comments">
                            <h5>Comentarios ({{count($image->comments)}})</h5>
                            <hr>
                            <form method="POST" action="{{ route('comment.save') }}">
                                @csrf
                                <input type="hidden" name="image_id" value="{{ $image->id }}">
                                <p>
                                    <textarea name="content" class="form-control {{$errors->has('content') ? 'is-invalid' : ''}}" ></textarea>
                                    @if($errors->has('content'))
                                        <spam class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('content') }}</strong>
                                        </spam>
                                    @endif
                                </p>
                                <button type="submit" class="btn btn-success">
                                    Enviar
                                </button>
                            </form>
                            <hr>
                            @foreach ($image->comments as $comment)
                                <div class="comment">
                                        <span class="nickname">{{'@'.$comment->user->nick}}</span>
                                        <span class="nickname date">{{' | '.\FormatTime::LongTimeFilter($comment->created_at) }}</span>
                                        <p>{{$comment->content }}
                                            <br>
                                            @if(Auth::check() && ($comment->user_id == Auth::user()->id || $comment->image->user_id == Auth::user()->id ))
                                                <a href="{{ route('comment.delete', ['id' => $comment->id]) }}" class="btn btn-sm btn-danger">
                                                    Eliminar
                                                </a>
                                            @endif
                                        </p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>
@endsection
