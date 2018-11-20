@extends('home.layouts.master')
@section('content')
       <div class="container mt-5">
           <div class="row">
               <div class="col-12">

                   <!-- Files -->
                   <div class="card" data-toggle="lists" data-lists-values="[&quot;name&quot;]">
                       <div class="card-header">
                           <div class="row align-items-center">
                               <div class="col">

                                   <!-- Title -->
                                   <h4 class="card-header-title">
                                       文章列表
                                   </h4>

                               </div>
                               <div class="col">
                                   <a href="{{route('home.article.create')}}" class="card-header-title">
                                       添加文章
                                   </a>
                               </div>

                           </div> <!-- / .row -->
                       </div>
                       <div class="card-header">
                           <div class="row">
                               <div class="col-12">

                                   <!-- Form -->
                                   <form>
                                       <div class="input-group input-group-flush input-group-merge">
                                           <input type="search" class="form-control form-control-prepended search" placeholder="Search">
                                           <div class="input-group-prepend">
                                               <div class="input-group-text">
                                                   <span class="fe fe-search"></span>
                                               </div>
                                           </div>
                                       </div>
                                   </form>

                               </div>
                           </div> <!-- / .row -->
                       </div>
                       <div class="card-body">

                           <!-- List -->
                           <ul class="list-group list-group-lg list-group-flush list my--4">
                               @foreach($articles as $article)
                               <li class="list-group-item px-0">

                                   <div class="row align-items-center">
                                       <div class="col-auto">

                                           <!-- Avatar -->
                                           <a href="#!" class="avatar avatar-sm">
                                               <img src="{{$article->user['icon']}}" alt="..." class="avatar-img rounded">
                                           </a>

                                       </div>
                                       <div class="col ml--2">

                                           <!-- Title -->
                                           <h4 class="card-title mb-1 name">
                                               <a href="#!">{{$article['title']}}</a>
                                           </h4>

                                           <!-- Text -->
                                           <p class="card-text small text-muted mb-1">
                                              {{$article->category->title}}
                                           </p>

                                           <!-- Time -->
                                           <p class="card-text small text-muted">
                                              {{$article->user['name']}}   <time datetime="2018-01-03">{{$article->created_at->diffForHumans()}}</time>
                                           </p>

                                       </div>

                                       <div class="col-auto">

                                           <!-- Dropdown -->
                                           <div class="dropdown">
                                               <a href="#!" class="dropdown-ellipses dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                   <i class="fe fe-more-vertical"></i>
                                               </a>
                                               <div class="dropdown-menu dropdown-menu-right">
                                                   @can('update',$article)
                                                   <a href="{{route('home.article.edit',$article)}}" class="dropdown-item">
                                                       编辑
                                                   </a>
                                                    @endcan
                                                   @can('update',$article)
                                                   <a href="javascript:;" onclick="del(this)" class="dropdown-item">
                                                       删除
                                                   </a>
                                                   <form action="{{route('home.article.destroy',$article)}}" method="post">
                                                       @csrf @method('DELETE')
                                                   </form>
                                                       @endcan
                                                   <a href="{{route('home.article.show',$article)}}" class="dropdown-item">
                                                       查看详情
                                                   </a>
                                               </div>
                                           </div>

                                       </div>
                                   </div> <!-- / .row -->

                               </li>
                               @endforeach
                           </ul>

                       </div>
                   </div>
                   {{$articles->links()}}
               </div>
           </div> <!-- / .row -->
       </div>
@endsection
@push('js')
    <script>
        function del(obj) {
            require(['https://cdn.bootcss.com/sweetalert/2.1.2/sweetalert.min.js'], function (swal) {
                swal("确定删除?", {
                    icon: 'warning',
                    buttons: {
                        cancel: "取消",
                        defeat: '确定',
                    },
                }).then((value) => {
                    switch (value) {
                        case "defeat":
                            $(obj).next('form').submit();
                            break;
                        default:

                    }
                });
            })
        }
    </script>
@endpush