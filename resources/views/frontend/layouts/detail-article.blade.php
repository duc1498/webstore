@extends('frontend.layouts.home')

@section('carousel')
    <main class="bg_gray">
        <div class="container margin_30">
            <div class="page_header">
                <div class="breadcrumbs">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Category</a></li>
                        <li>Page active</li>
                    </ul>
                </div>
            </div>
            <!-- /page_header -->
            <div class="row">
                <div class="col-lg-9">
                    <div class="singlepost">
                        <figure>
                            @if ($article->image && file_exists(public_path($article->image)))
                                <img alt="" class="img-fluid" src="{{ asset($article->image) }}">
                            @else
                                <img src="{{ asset('upload/azaka.jpg') }}" class="img-fluid">
                            @endif
                        </figure>
                        <h1>Ei pro alia placerat theophrastus</h1>
                        <div class="postmeta">
                            <ul>
                                <li><a href="#"><i class="ti-folder"></i> Category</a></li>
                                <li><i class="ti-calendar"></i> 23/12/2015</li>
                                <li><a href="#"><i class="ti-user"></i> Admin</a></li>
                                <li><a href="#"><i class="ti-comment"></i> (14) Comments</a></li>
                            </ul>
                        </div>
                        <!-- /post meta -->
                        <div class="post-content">
                            <div class="dropcaps">
                                <p>Aorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum
                                    has been the industry's standard dummy text ever since the 1500s, when an unknown
                                    printer took a galley of type and scrambled it to make a type specimen book. It has
                                    survived not only five centuries, but also the leap into electronic typesetting,
                                    remaining essentially unchanged. It was popularised in the 1960s with the release of
                                    Letraset sheets containing Lorem Ipsum passages, and more recently with desktop
                                    publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                            </div>

                            <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of
                                classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a
                                Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure
                                Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the
                                word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from
                                sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and
                                Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very
                                popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit
                                amet..", comes from a line in section 1.10.32.</p>
                        </div>
                        <!-- /post -->
                    </div>
                    <!-- /single-post -->

                    <div id="comments">
                        <h5>Comments</h5>
                        <ul>
                            <li>
                                <div class="avatar">
                                    <a href="#"><img src="img/avatar1.jpg" alt="">
                                    </a>
                                </div>
                                <div class="comment_right clearfix">
                                    <div class="comment_info">
                                        By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a
                                            href="#"><i class="icon-reply"></i></a>
                                    </div>
                                    <p>
                                        Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non pellentesque
                                        arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis natoque penatibus et
                                        magnis dis parturient montes, nascetur ridiculus mus. Sed sit amet sem a urna
                                        rutrumeger fringilla. Nam vel enim ipsum, et congue ante.
                                    </p>
                                </div>
                                <ul class="replied-to">
                                    <li>
                                        <div class="avatar">
                                            <a href="#"><img src="img/avatar2.jpg" alt="">
                                            </a>
                                        </div>
                                        <div class="comment_right clearfix">
                                            <div class="comment_info">
                                                By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a
                                                    href="#"><i class="icon-reply"></i></a>
                                            </div>
                                            <p>
                                                Nam cursus tellus quis magna porta adipiscing. Donec et eros leo, non
                                                pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna. Cum sociis
                                                natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
                                                Sed sit amet sem a urna rutrumeger fringilla. Nam vel enim ipsum, et congue
                                                ante.
                                            </p>
                                            <p>
                                                Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut. Pellentesque
                                                ullamcorper venenatis elit idaipiscingi Duis tellus neque, tincidunt eget
                                                pulvinar sit amet, rutrum nec urna. Suspendisse pretium laoreet elit vel
                                                ultricies. Maecenas ullamcorper ultricies rhoncus. Aliquam erat volutpat.
                                            </p>
                                        </div>
                                        <ul class="replied-to">
                                            <li>
                                                <div class="avatar">
                                                    <a href="#"><img src="img/avatar2.jpg" alt="">
                                                    </a>
                                                </div>
                                                <div class="comment_right clearfix">
                                                    <div class="comment_info">
                                                        By <a href="#">Anna
                                                            Smith</a><span>|</span>25/10/2019<span>|</span><a
                                                            href="#"><i class="icon-reply"></i></a>
                                                    </div>
                                                    <p>
                                                        Nam cursus tellus quis magna porta adipiscing. Donec et eros leo,
                                                        non pellentesque arcu. Curabitur vitae mi enim, at vestibulum magna.
                                                        Cum sociis natoque penatibus et magnis dis parturient montes,
                                                        nascetur ridiculus mus. Sed sit amet sem a urna rutrumeger
                                                        fringilla. Nam vel enim ipsum, et congue ante.
                                                    </p>
                                                    <p>
                                                        Aenean iaculis sodales dui, non hendrerit lorem rhoncus ut.
                                                        Pellentesque ullamcorper venenatis elit idaipiscingi Duis tellus
                                                        neque, tincidunt eget pulvinar sit amet, rutrum nec urna.
                                                        Suspendisse pretium laoreet elit vel ultricies. Maecenas ullamcorper
                                                        ultricies rhoncus. Aliquam erat volutpat.
                                                    </p>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <div class="avatar">
                                    <a href="#"><img src="img/avatar3.jpg" alt="">
                                    </a>
                                </div>

                                <div class="comment_right clearfix">
                                    <div class="comment_info">
                                        By <a href="#">Anna Smith</a><span>|</span>25/10/2019<span>|</span><a
                                            href="#"><i class="icon-reply"></i></a>
                                    </div>
                                    <p>
                                        Cursus tellus quis magna porta adipiscin
                                    </p>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <hr>

                    <h5>Leave a comment</h5>
                    <div class="row">
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="name" id="name2" class="form-control" placeholder="Name">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-6">
                            <div class="form-group">
                                <input type="text" name="email" id="email2" class="form-control"
                                    placeholder="Email">
                            </div>
                        </div>
                        <div class="col-md-4 col-sm-12">
                            <div class="form-group">
                                <input type="text" name="email" id="website3" class="form-control"
                                    placeholder="Website">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" name="comments" id="comments2" rows="6" placeholder="Comment"></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="submit2" class="btn_1 add_bottom_15">Submit</button>
                    </div>

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </main>
@endsection
