@extends('[[custom_master]]')

@section('content')
<div class="form-panel">

    <h3>List of {{ ucfirst('[[model_plural]]') }}</h3>

    @if(!$[[model_plural]]->isEmpty())
    <table class="table highlight" id="tbl-datatable">
        <thead>
        <tr>
            [[foreach:columns]]
            <th>[[i.display]]</th>
            [[endforeach]]
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach($[[model_plural]] as $[[model_singular]])
        <tr>
            [[foreach:columns]]
            <td>{{ $[[model_singular]]->[[i.name]] }}</td>
            [[endforeach]]
            <td>
                <a href="{{route('[[route_path]].destroy', [$[[model_singular]]->id])}}"
                   title="Delete" class="btn btn-flat btn-small right "
                   onclick="return doDelete({!! $[[model_singular]]->id !!})"><i class="material-icons">delete</i></a>
                <a href="{{route('[[route_path]].edit', [$[[model_singular]]->id])}}"
                   title="Edit" class="btn btn-flat btn-small raised right"><i class="material-icons">mode_edit</i></a>
                <a href="{{route('[[route_path]].show', [$[[model_singular]]->id])}}" title="View"
                   class="btn btn-flat btn-small right raised"><i class="material-icons">visibility</i></a>
            </td>
        </tr>
        @endforeach
        </tbody>
    </table>
    {!! $[[model_plural]]->render() !!}
    <!--<ul class="pagination">
        <li class="disabled"><a href="#!"><i class="material-icons">chevron_left</i></a></li>
        <li class="active"><a href="#!">1</a></li>
        <li class="waves-effect"><a href="#!">2</a></li>
        <li class="waves-effect"><a href="#!">3</a></li>
        <li class="waves-effect"><a href="#!">4</a></li>
        <li class="waves-effect"><a href="#!">5</a></li>
        <li class="waves-effect"><a href="#!"><i class="material-icons">chevron_right</i></a></li>
    </ul>
    <!-- have pagination work inside the form-panel -->
    <div class="clearfix"></div>
</div>
@else
<h3 class="center-align"> No {{ ucfirst('[[model_plural]]') }} found.</h3>
@endif
<div class="fixed-action-btn">
    <a class="btn-floating btn-large amber" title="Add {{ ucfirst('[[model_uc]]') }}"
       href="{{url('[[route_path]]/create')}}">
        <i class="large material-icons">add</i>
    </a>

</div>

@endsection

@section('scripts')

<script type="text/javascript">
  var theGrid = null;
  //        $(document).ready(function(){
  //            table = $('#tbl-datatable').DataTable({
  //                "processing": true,
  //                "ordering": true,
  //                "responsive": true,
  //                "paging": false
  //            });
  //        });

  function doDelete(id) {
    if (confirm('Do you really want to delete this record?')) {
      $.ajax({
        url: '{{ url(' / [[route_path]]') }}/' +id,
        type: 'DELETE',
        success: function () {
          window.location.reload();
        },
        error: function () {
          alert('Woops! Something went wrong. Internal error.');
        }
      });
    }
    return false;
  }
</script>

@endsection
