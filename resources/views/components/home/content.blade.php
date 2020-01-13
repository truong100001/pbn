
@if(session('message'))
    <script>
        Swal.fire({
            icon: 'success',
            text:"Thêm thành công",
            showConfirmButton: true,
            timer:3000
        });
    </script>
@endif

@if(session('message2'))
    <script>
        Swal.fire({
            icon: 'success',
            text:"Quét hoàn thành",
            showConfirmButton: true,
            timer:3000
        });
    </script>
@endif
<!-- Breadcomb area Start-->
<div class="row" style="margin-top: 50px;">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="widget-tabs-list tab-pt-mg sm-res-mg-t-30 tb-res-mg-t-30">
            <ul class="nav nav-tabs tab-nav-center">
                <li class="active"><a data-toggle="tab" href="#home4">PBN</a></li>
                <li><a data-toggle="tab" href="#menu14">Key word</a></li>
            </ul>
            <div class="tab-content tab-custom-st">
                <div id="home4" class="tab-pane in active animated zoomInRight">
                    <div class="breadcomb-area" style="margin-top: 30px;">
                        <div class="container1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="breadcomb-list">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="breadcomb-wp">
                                                    <div class="breadcomb-icon">
                                                        <i class="fas fa-network-wired"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                                <div class="breadcomb-report">
                                                    <a href="{{asset('/check-domain')}}">
                                                        <button data-toggle="tooltip" data-placement="left" title="Quét" class="btn">
                                                            <i class="notika-icon notika-refresh"></i>
                                                        </button>
                                                    </a>
                                                    <a href="{{asset('/add-domain')}}">
                                                        <button data-toggle="tooltip" data-placement="top" title="Thêm mới" class="btn"><i class="fas fa-plus"></i></button>
                                                    </a>
                                                    <button data-toggle="tooltip" data-placement="bottom" title="Nhập từ file excel" class="btn"><i class="fas fa-file-excel"></i></button>

                                                    <button data-toggle="tooltip" data-placement="bottom" title="Lọc" class="btn"><i class="fas fa-filter"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Breadcomb area End-->
                    <!-- Data Table area Start-->
                    <div class="data-table-area">
                        <div class="container1">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="data-table-list">
                                        <div class="table-responsive">
                                            <table id="data-table-basic" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Domain</th>
                                                    <th>RD</th>
                                                    <th>Whois</th>
                                                    <th>DNS</th>
                                                    <th>CDN</th>
                                                    <th>IP (VPS)</th>
                                                    <th>Nhà đăng ký</th>
                                                    <th>Email mua</th>
                                                    <th>Ngày hết hạn</th>
                                                    <th>Ngày đăng ký</th>
                                                    <th>Link to</th>
                                                    <th>Anchor</th>
                                                    <th>Số bài</th>
                                                    <th>Bài gần nhất</th>
                                                    <th>Action</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($domains as $i => $domain)
                                                <tr>
                                                    <td>{{$i+1}}</td>
                                                    <td>

                                                        @if($domain->status_domain ==1)
                                                            <span class="text-success"> {{$domain->domain}}<i class="fas fa-check-circle"></i></span>
                                                        @else
                                                            <span class="text-danger"> {{$domain->domain}}<i class="fas fa-times-circle"></i></span>

                                                        @endif
                                                    </td>
                                                    <td>{{$domain->rd}}</td>
                                                    <td>
                                                        @if($domain->whois == 1)
                                                            {{'public'}}
                                                        @else
                                                            {{'private'}}
                                                         @endif
                                                    </td>
                                                    <td>
                                                        <p class="dns">{{$domain->dns}}</p>
                                                    </td>
                                                    <td>
                                                        {{$domain->cdn}}
                                                    </td>
                                                    <td>
                                                        @if($domain->status_ip ==1)
                                                            <span class="text-success">{{$domain->ip}}<i class="fas fa-check-circle"></i></span>
                                                        @else
                                                            <span class="text-danger">{{$domain->ip}}<i class="fas fa-times-circle"></i></span>

                                                        @endif
                                                    </td>
                                                    <td>{{$domain->name_register}}</td>
                                                    <td>{{$domain->email}}</td>
                                                    <td>
                                                        {{$domain->expired_date}}
                                                        <span class="bage"> 23 </span>
                                                    </td>
                                                    <td>{{$domain->register_date}}</td>
                                                    <td>{{$domain->link_to}}</td>
                                                    <td>{{$domain->anchor}}</td>
                                                    <td>{{$domain->num_post}}</td>
                                                    <td>{{$domain->latest_post}}</td>
                                                    <td>
                                                        <button class="btn btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-edit"></i> Sửa</button>
                                                        <button class="btn  btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-close"></i> Xóa</button>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                </tbody>
                                                <tfoot>
                                                {{--<tr>--}}
                                                    {{--<th>STT</th>--}}
                                                    {{--<th>Domain</th>--}}
                                                    {{--<th>RD</th>--}}
                                                    {{--<th>Whois</th>--}}
                                                    {{--<th>DNS</th>--}}
                                                    {{--<th>CDN</th>--}}
                                                    {{--<th>IP (VPS)</th>--}}
                                                    {{--<th>Nhà đăng ký</th>--}}
                                                    {{--<th>Email mua</th>--}}
                                                    {{--<th>Expired date</th>--}}
                                                    {{--<th>Ngày đăng ký</th>--}}
                                                    {{--<th>Link to</th>--}}
                                                    {{--<th>Anchor</th>--}}
                                                    {{--<th>Số bài</th>--}}
                                                    {{--<th>Bài gần nhất</th>--}}
                                                    {{--<th>Action</th>--}}
                                                {{--</tr>--}}
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="menu14" class="tab-pane animated zoomInRight">
                    <div class="breadcomb-area" style="margin-top: 30px;">
                        <div class="container1 listKeyWord">
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="breadcomb-list">
                                        <div class="row">
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                                <div class="breadcomb-wp">
                                                    <div class="breadcomb-icon">
                                                        <i class="fas fa-key"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-3">
                                                <div class="breadcomb-report">
                                                    <button data-toggle="tooltip" data-placement="left" title="Quét" class="btn">
                                                        <i class="notika-icon notika-refresh"></i>
                                                    </button>

                                                    <button data-toggle="modal" data-target="#myModalone" data-toggle="tooltip" data-placement="top" title="Thêm mới" class="btn"><i class="fas fa-plus"></i></button>
                                                    <div class="modal fade" id="myModalone" role="dialog">
                                                        <div class="modal-dialog modals-default">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="form-example-wrap">
                                                                        <div class="cmp-tb-hd">
                                                                            <h2>Thêm mới</h2>
                                                                        </div>
                                                                        <form action="{{asset('/add-keyword')}}" method="post">
                                                                            {{csrf_field()}}
                                                                            <div class="row">
                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                                    <div class="form-group ic-cmp-int">
                                                                                        <div class="form-ic-cmp">
                                                                                            <i class="far fa-address-card"></i>
                                                                                        </div>
                                                                                        <div class="chosen-select-act fm-cmp-mg">
                                                                                            <select name="id_domain" class="chosen" data-placeholder="Choose a Country...">
                                                                                                @foreach($domains as $domain)
                                                                                                    <option value="{{$domain->id}}">{{$domain->domain}}</option>
                                                                                                @endforeach
                                                                                            </select>
                                                                                        </div>

                                                                                    </div>
                                                                                </div>

                                                                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" style="margin-top: 20px;">
                                                                                    <div class="form-group ic-cmp-int">
                                                                                        <div class="form-ic-cmp">
                                                                                            <i class="notika-icon notika-edit"></i>
                                                                                        </div>
                                                                                        <div class="nk-int-st">
                                                                                            <input name="keyword" type="text" class="form-control" placeholder="Nhập từ khóa">
                                                                                            @if($errors->has('keyword'))
                                                                                                <div class="text-danger text-small">{{ $errors->first('keyword') }}</div>
                                                                                            @endif
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-example-int mg-t-15">
                                                                                <button class="btn btn-success notika-btn-success">Thêm</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button data-toggle="tooltip" data-placement="bottom" title="Nhập từ file excel" class="btn"><i class="fas fa-file-excel"></i></button>

                                                    <button data-toggle="tooltip" data-placement="bottom" title="Lọc" class="btn"><i class="fas fa-filter"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Breadcomb area End-->
                    <!-- Data Table area Start-->
                    <div class="data-table-area">
                        <div class="container1 " >
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="data-table-list">
                                        <div class="table-responsive">
                                            <table id="data-table-basic1" class="table table-striped">
                                                <thead>
                                                <tr>
                                                    <th>STT</th>
                                                    <th>Domain</th>
                                                    <th>Key word</th>
                                                    <th>Thứ hạng</th>
                                                    <th>Ngày quét gần nhất</th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($keywords as $i => $keyword)
                                                    <tr>
                                                        <td>{{$i+1}}</td>
                                                        <td>{{$keyword->domain}}</td>
                                                        <td>{{$keyword->key_word}}</td>
                                                        <td>{{$keyword->rank}}</td>
                                                        <td>{{$keyword->updated_at}}</td>
                                                        <td>
                                                            <button class="btn btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-menu"></i>Xem lịch sử</button>
                                                            <button class="btn btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-edit"></i> Sửa</button>
                                                            <button class="btn  btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-close"></i> Xóa</button>
                                                        </td>
                                                    </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
