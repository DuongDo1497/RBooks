                    {{-- @if(empty($comments->first()))
                        <h5 class="text-center mt-4">{{trans('home.Hiện tại chưa có nhận xét !!!')}}</h5>
                    @else
                    @foreach($comments as $comment)
                    <div class="row pb-0">
                        <div class="col-md-2 col-12 text-center">
                            <img src="{{ asset('imgs/avatar_default.png') }}" class="comment-avatar" alt="">
                            <!--<div class="h6">{{ $comment->customer->fullname }}</div>-->
                            <div>{{ $comment->created_at->format('d/m/Y') }}</div>
                        </div>
                        <div class="col-md-10 col-12">
                            <div class="text-nowrap">
                                @for($i = 0; $i < $comment->rate; $i++)
                                <img class="pb-2" src="{{ asset('imgs/star.jpg') }}" alt="Đánh giá">
                                {{-- <img src="{{ asset('imgs/none_star.jpg') }}" alt="Đánh giá"> --}}
                                @endfor
                                @switch($comment->rate)
                                    @case(1)
                                        <span class="ml-3 h5">Rất không hài lòng</span>
                                        @break
                                    @case(2)
                                        <span class="ml-3 h5">Không hài lòng</span>
                                        @break
                                    @case(3)
                                        <span class="ml-3 h5">Bình thường</span>
                                        @break
                                    @case(4)
                                        <span class="ml-3 h5">Hài Lòng</span>
                                        @break
                                    @default
                                        <span class="ml-3 h5">Rất hài lòng</span>
                                @endswitch
                            </div>
                            <div class="comment">
                                {{ $comment->content }}
                            </div>
                            <div class="row">
                                <div class="col-sm-2 col-3 pt-2"><a href="#" style="color: #283b91;"><i class="fas fa-reply"></i> {{trans('home.Trả lời')}}</a></div>
                                <div class="col-sm-2 col-3 pt-2"><a href="#" style="color: #283b91;"><i class="fas fa-share"></i> Share</a></div>
                                <div class="col-sm-4 col-6">
                                    {{trans('home.Nhận xét này hữu ích với bạn?')}} <button class="btn btn-thank">{{trans('home.Cảm ơn')}}</button>
                                </div>
                                <div class="col-sm-4 col-0"></div>
                            </div>
                        </div>
                    </div>
                    <hr>
                    @endforeach
                    @endif --}}