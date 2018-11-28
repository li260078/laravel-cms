@extends('home.layouts.master')
@section('content')
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
                                                    <a href="#！" class="nav-link ">

                                                        所有通知
                                                    </a>
                                                </li>


                                            </ul>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="list-group list-group-flush my--3">
                                        @foreach($notifycations as $notification)
                                            <a class="list-group-item px-0"
                                               href="{{route('member.notify.show',$notification)}}">

                                                <div class="row">
                                                    <div class="col-auto">

                                                        <!-- Avatar -->
                                                        <div class="avatar avatar-sm">
                                                            <img src="{{$notification['data']['user_icon']}}" alt="..."
                                                                 class="avatar-img rounded-circle">
                                                        </div>

                                                    </div>
                                                    <div class="col ml--2">

                                                        <!-- Content -->
                                                        <div class="small text-muted">
                                                            @if($notification['read_at'])
                                                                已读
                                                                <strong class="text-body">{{$notification['data']['user_name']}}</strong>
                                                                评论了
                                                                <strong class="text-body">{{$notification['data']['article_title']}}</strong>
                                                            @else
                                                                未读
                                                                <strong class="text-body">{{$notification['data']['user_name']}}</strong>
                                                                评论了
                                                                <strong class="text-body">{{$notification['data']['article_title']}}</strong>
                                                            @endif
                                                        </div>

                                                    </div>


                                                    <div class="col-auto">

                                                        <small class="text-muted">
                                                            {{$notification->created_at->diffForHumans()}}
                                                        </small>

                                                    </div>
                                                </div> <!-- / .row -->

                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection