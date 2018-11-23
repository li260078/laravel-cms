@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('memder.layouts.menu')
            <div class="col-sm-9">
                <div class="container-fluid">
                    @if($fans->count() == 0)
                        <p class="text-muted text-center p-5">暂无关注</p>
                    @else
                        <div class="row">
                            @foreach($fans as $fan)
                                <div class="col-12 col-md-6 col-xl-3">
                                    <!-- Card -->
                                    <div class="card">
                                        <div class="card-body text-center">

                                            <a href="{{route('member.user.show',$fan)}}"
                                               class="avatar avatar-xl card-avatar ">
                                                <img src="{{$fan['icon']}}"
                                                     class="avatar-img rounded-circle border border-white" alt="...">
                                            </a>
                                            <h2 class="card-title">
                                                <a href="{{route('member.user.show',$fan)}}">{{$fan['name']}}</a>
                                            </h2>
                                            <p class="card-text text-muted">
                                                <small>
                                                    个性签名：无敌是多么，多么寂寞
                                                </small>
                                            </p>
                                            <p class="card-text">
                                            <span class="badge badge-soft-secondary">
                                                粉丝:{{$fan->fans->count()}}
                                            </span>
                                                <span class="badge badge-soft-secondary">
                                                关注:{{$fan->following->count()}}
                                            </span>
                                            </p>
                                            <hr>
                                            <div class="row  align-items-center justify-content-between">
                                                @auth()
                                                    <div class="col-auto " style="margin: 0 auto">
                                                        @can('isNotMine',$fan)
                                                        <a href="{{route('member.attention',$fan)}}"
                                                           class="btn btn-sm btn-primary">
                                                            @if($fan->fans->contains(auth()->user()))
                                                                <i class="fa fa-minus" aria-hidden="true"></i> 取消关注
                                                            @else
                                                                <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                                                            @endif
                                                        </a>
                                                        @endcan
                                                    </div>
                                                @endauth
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        {{$fans->links()}}
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection