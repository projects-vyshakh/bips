<div class="row">
    <div class="col-12">
        <div class="card-box">

            <div class="table-responsive">
                <table class="table table-centered mb-0">
                    <thead class="font-13 bg-light text-muted">
                    <tr>
                        <th class="font-weight-medium">File Name</th>
                        <th class="font-weight-medium">Date Modified</th>
                        {{--<th class="font-weight-medium text-center" style="width: 125px;">Action</th>--}}
                    </tr>
                    </thead>
                    <tbody>
                    @if(!empty($media))
                        @foreach($media as $data)
                            <tr>
                                <td>
                                    <a href="javascript:void(0);" class="text-dark">{{$data['filename'].".".$data['extension']}}</a>
                                </td>
                                <td class="text-muted font-13">{{date('d-M-Y',strtotime($data['updated_at']))}}</td>

                                {{--<td>
                                    <a href="javascript:void(0);" class="btn btn-link font-18 text-muted btn-sm">
                                        <i class="mdi mdi-close"></i>
                                    </a>
                                    <a href="javascript:void(0);" class="btn btn-link font-18 text-muted btn-sm">
                                        <i class="mdi mdi-pencil"></i>
                                    </a>
                                </td>--}}
                            </tr>
                        @endforeach
                    @endif


                    </tbody>
                </table>
            </div>
        </div>
    </div> <!-- end col -->
</div>
<!-- end row -->





