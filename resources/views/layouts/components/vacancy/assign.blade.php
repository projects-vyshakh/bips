
<div class="row">
    <div class="col-lg-12">
        <div class="card card-body">
            <h4 class="card-title">Employee List</h4>
            <table id="data-table" class="table table-striped table-bordered" style="width:100%">
                <thead>
                <tr>
                    <th>Sl.No</th>
                    <th>Employee Name</th>
                    <th>Qualification</th>

                </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                </tbody>

            </table>
        </div>



    </div>
</div>
@section('scripts')
    @include('layouts.components.scripts.datatables.tables')
    @include('layouts.components.scripts.sweetalert.sweetalert')

    <script src="../public/assets/js/vacancy/manage.js"></script>
@endsection
