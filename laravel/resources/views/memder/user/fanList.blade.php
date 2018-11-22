@extends('home.layouts.master')
@section('content')
    <div class="container mt-5">
        <div class="row">
            @include('memder.layouts.menu')
            @foreach($fans as $fan)
            <div class="col-12 col-md-6 col-xl-2">
                <!-- Card -->
                <div class="card">
                    <div class="card-body text-center">

                        <a href="{{route('member.user.show',$fan)}}" class="avatar avatar-xl card-avatar ">
                            <img src="{{$fan->icon}}" class="avatar-img rounded-circle border border-white" alt="...">
                        </a>
                        <h2 class="card-title">
                            <a href="{{route('member.user.show',$fan)}}">{{$fan->name}}</a>
                        </h2>
                        <p class="card-text text-muted">
                            <small>
                                个性签名：无敌是多么，多么寂寞
                            </small>
                        </p>
                        <p class="card-text">
                  <span class="badge badge-soft-secondary">
                    UX Team
                  </span>
                            <span class="badge badge-soft-secondary">
                    Research Team
                  </span>
                        </p>
                        <hr>
                        <div class="row  align-items-center justify-content-between" >
                            <div class="col-auto " style="margin: 0 auto">
                                <a href="{{route('member.attention',$fan)}}" class="btn btn-sm btn-primary">
                                    @if($fan->fans->contains(auth()->user()))
                                        <i class="fa fa-minus" aria-hidden="true"></i> 取消关注
                                    @else
                                        <i class="fa fa-plus" aria-hidden="true"></i> 关注 TA
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
@endsection