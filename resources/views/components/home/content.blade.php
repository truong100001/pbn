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
                                                    <button data-toggle="tooltip" data-placement="left" title="Quét" class="btn">
                                                        <i class="notika-icon notika-refresh"></i>
                                                    </button>
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
                                                    <td>{{$domain->domain}}</td>
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
                        <div class="container">
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
                        <div class="container">
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
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>1</td>
                                                        <td>123</td>
                                                        <td>123</td>
                                                        <td>
                                                           123
                                                        </td>
                                                        <td>
                                                            <button class="btn btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-edit"></i> Sửa</button>
                                                            <button class="btn  btn-small btn-default btn-icon-notika waves-effect"><i class="notika-icon notika-close"></i> Xóa</button>
                                                        </td>
                                                    </tr>

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
