<div class="card" id="app">
    <div class="card-body">

        <!-- Comments -->

        <div class="comment mb-3" v-for="v in comments">
            <div class="row">
                <div class="col-auto">

                    <!-- Avatar -->
                    <a class="avatar" href="">
                        <img :src="v.user.icon" alt="..." class="avatar-img rounded-circle">
                    </a>

                </div>
                <div class="col ml--2">

                    <!-- Body -->
                    <div class="comment-body">

                        <div class="row">
                            <div class="col">

                                <!-- Title -->
                                <h5 class="comment-title">
                                    @{{v.user.name}}
                                </h5>

                            </div>
                            <div class="col-auto">

                                <!-- Time -->
                                <time class="comment-time">
                                    @auth
                                        <a href="" @click.prevent="zan(v)">👍 </a> | @{{v.zan_num}} |@{{v.created_at}}
                                    @else
                                        <a href="{{route('login',['from'=>url()->full()])}}" >👍 </a>
                                    @endauth
                                </time>

                            </div>
                        </div> <!-- / .row -->

                        <!-- Text -->
                        <p class="comment-text" v-html="v.content">
                        </p>

                    </div>

                </div>
            </div> <!-- / .row -->
        </div>


        <!-- Divider -->
        <hr>

        <!-- Form -->
        @auth()
            <div class="row align-items-start">
                <div class="col-auto">

                    <!-- Avatar -->
                    <div class="avatar">
                        <img src="{{auth()->user()->icon}}" alt="..." class="avatar-img rounded-circle">
                    </div>

                </div>
                <div class="col ml--2">

                    <div id="editormd">
                        <textarea style="display:none;"></textarea>
                    </div>
                    <button class="btn btn-primary" @click.prevent="send()">发表评论</button>

                </div>
            </div> <!-- / .row -->
        @else
            <p class="text-muted text-center">请 <a href="{{route('login',['from'=>url()->full()])}}">登录</a> 后评论</p>
        @endauth
        {{--@{{comment}}--}}
    </div>
</div>
@push('js')
    <script>
        require(['hdjs', 'vue', 'axios', 'MarkdownIt', 'marked', 'highlight'], function (hdjs, Vue, axios, MarkdownIt, marked) {
            var vm = new Vue({
                el: '#app',
                data: {
                    comment: {content: ''},//当前评论数据
                    comments: [],//全部评论

                },
                updated(){
                    $(document).ready(function () {
                        $('pre code').each(function (i, block) {
                            hljs.highlightBlock(block);
                        });
                    });
                },
                methods: {
                    //第一步
                    @auth
                    send() {
                        this.comment.content.trim() == ''
                        if (this.comment.content.trim() == '') {
                            hdjs.swal({
                                text: "请输入评论内容",
                                button: false,
                                icon: 'warning'
                            });
                            return false;
                        }
                        //第二🙅步
                        axios.post('{{route('home.comment.store')}}', {
                            content: this.comment.content,
                            article_id: '{{$article['id']}}'
                        })
                            .then((response) => {
                                //console.log(response.data.comment);
                                this.comments.push(response.data.comment);
                                //将 markdown 转为 html
                                let md = new MarkdownIt();
                                response.data.comment.content = md.render(response.data.comment.content)

                                //清空 vue 数据
                                this.comment.content = '';
                                //清空编辑器内容
                                //选中所有内容
                                editormd.setSelection({line: 0, ch: 0}, {line: 9999999, ch: 9999999});
                                //将选中文本替换成空字符串
                                editormd.replaceSelection("");
                            })

                    },
                    zan(v){
                        //alert(1)
                        let url ='/home/zan/make?type=comment&id='+ v.id;
                        //console.log(url);
                        axios.get(url).then((response)=>{
                            v.zan_num=response.data.zan_num;
                            //vm.num.push(response.data.num);
                           // console.log(vm.num);
                        })
                    }
                    @endauth
                },
                mounted() {
                    @auth
                    hdjs.editormd("editormd", {
                        width: '100%',
                        height: 300,
                        toolbarIcons: function () {
                            return [
                                "undo", "redo", "|",
                                "bold", "del", "italic", "quote", "|",
                                "list-ul", "list-ol", "hr", "|",
                                "link", "hdimage", "code-block", "|",
                                "watch", "preview", "fullscreen"
                            ]
                        },
                        //后台上传地址，默认为 hdjs配置项window.hdjs.uploader
                        server: '',
                        //editor.md库位置
                        path: "{{asset('org/hdjs')}}/package/editor.md/lib/",

                        //第三步
                        //监听编辑器变化
                        onchange: function () {
                            //给 vu 对象中 comment 属性中 content 设置值
                            vm.$set(vm.comment, 'content', this.getValue());
                        }

                    });
                    @endauth
                    //第四步
                    //请求当前文章所有评论数据
                    axios.get('{{route("home.comment.index",['article_id'=>$article['id']])}}')
                        .then((response) => {
                            //console.log(response.data.comments)
                            this.comments = response.data.comments;
                            let md = new MarkdownIt();
                            //console.log(this.comments);
                            this.comments.forEach((v, k) => {
                                v.content = md.render(v.content)

                                //console.log(v.zan.length);
                            })

                        });
                }
            });
        })
    </script>

@endpush