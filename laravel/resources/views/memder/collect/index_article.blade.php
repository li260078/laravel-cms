@extends('home.layouts.master')
@section('content')
    <div class="main-content">

        <div class="container mt-5">
            <div class="row">
                @include('memder.layouts.menu')
                <div class="col-sm-9">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-12">

                                <!-- Files -->
                                <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                                    <div class="card-header">
                                        <div class="row align-items-center">
                                            <div class="col">

                                                <!-- Nav -->
                                                <ul class="nav nav-tabs nav-overflow header-tabs">
                                                    <li class="nav-item">
                                                        <a href="" class="nav-link active">
                                                            我的收藏
                                                        </a>
                                                    </li>
                                                </ul>

                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-body">

                                        <!-- List -->
                                        <ul class="list-group list-group-lg list-group-flush list my--4">
                                            @foreach($collects as $collect)
                                                <li class="list-group-item px-0">

                                                    <div class="row align-items-center">

                                                        <div class="col ml--2">

                                                            <!-- Title -->
                                                            <h4 class="card-title mb-1 name">
                                                                <a href="{{route('home.article.show',$collect->belongsModel)}}">{{$collect->belongsModel->title}}</a>
                                                            </h4>

                                                            <p class="card-text small mb-1">
                                                                <a href="{{route('member.user.show',$collect->belongsModel->user)}}" class="text-secondary mr-2">
                                                                    <i class="fa fa-user-circle"
                                                                       aria-hidden="true"></i>{{$collect->belongsModel->user->name}}
                                                                </a>

                                                                <i class="fa fa-clock-o"
                                                                   aria-hidden="true"></i>
                                                                {{$collect->belongsModel->created_at->diffForHumans()}}

                                                                <a href="" class="text-secondary ml-2">
                                                                    <i class="fa fa-folder-o"
                                                                       aria-hidden="true"></i>
                                                                    {{$collect->belongsModel->category->title}}
                                                                </a>
                                                            </p>

                                                        </div>
                                                        <div class="col-auto">

                                                            <!-- Dropdown -->
                                                            <div class="dropdown">
                                                                <a href="{{route('member.collect.make',['type'=>'article','id'=>$collect->belongsModel->id])}}" >

                                                                    取消收藏
                                                                </a>

                                                            </div>

                                                        </div>


                                                    </div>

                                                </li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                                {{$collects->appends(['type'=>Request::query('type')])->links()}}

                            </div>
                        </div> <!-- / .row -->

                    </div>
                </div>

            </div>
        </div>

    </div>
@endsection