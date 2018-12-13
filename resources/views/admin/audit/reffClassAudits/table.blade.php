<table class="table table-responsive table-striped table-bordered" id="reffClassAudits-table" width="100%">
    <thead>
     <tr>
        <th>Definition</th>
        <th>Is Active</th>
        <th >Action</th>
     </tr>
    </thead>
    <tbody>
    @foreach($reffClassAudits as $reffClassAudit)
        <tr>
            <td>{!! $reffClassAudit->definition !!}</td>
            <td>{!! $reffClassAudit->is_active !!}</td>
            <td>
                 <a href="{{ route('admin.audit.reffClassAudits.show', collect($reffClassAudit)->first() ) }}">
                     <i class="livicon" data-name="info" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="view reffClassAudit"></i>
                 </a>
                 <a href="{{ route('admin.audit.reffClassAudits.edit', collect($reffClassAudit)->first() ) }}">
                     <i class="livicon" data-name="edit" data-size="18" data-loop="true" data-c="#428BCA" data-hc="#428BCA" title="edit reffClassAudit"></i>
                 </a>
                 <a href="{{ route('admin.audit.reffClassAudits.confirm-delete', collect($reffClassAudit)->first() ) }}" data-toggle="modal" data-target="#delete_confirm">
                     <i class="livicon" data-name="remove-alt" data-size="18" data-loop="true" data-c="#f56954" data-hc="#f56954" title="delete reffClassAudit"></i>
                 </a>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>
@section('footer_scripts')

    <div class="modal fade" id="delete_confirm" tabindex="-1" role="dialog" aria-labelledby="user_delete_confirm_title" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            </div>
        </div>
    </div>
    <script>$(function () {$('body').on('hidden.bs.modal', '.modal', function () {$(this).removeData('bs.modal');});});</script>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}"/>
<link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/dataTables.bootstrap.css') }}"/>
 <link rel="stylesheet" type="text/css" href="{{ asset('assets/vendors/datatables/css/buttons.bootstrap.css') }}">
<script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/jquery.dataTables.js') }}" ></script>
 <script type="text/javascript" src="{{ asset('assets/vendors/datatables/js/dataTables.bootstrap.js') }}" ></script>

    <script>
        $('#reffClassAudits-table').DataTable({
                      responsive: true,
                      pageLength: 10
                  });
                  $('#reffClassAudits-table').on( 'page.dt', function () {
                     setTimeout(function(){
                           $('.livicon').updateLivicon();
                     },500);
                  } );

       </script>

@stop