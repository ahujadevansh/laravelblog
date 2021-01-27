@extends('layouts.app')

@section('content')

    <div class="d-flex justify-content-end">
    <a href="{{ route('tags.create') }}" class="btn btn-primary">Add Tag</a>
    </div>

    <div class="card">
        <div class="card-header">
            Tags
        </div>

        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <th>Name</th>
                    <th>Count</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($tags as $tag)
                        <tr>
                            <td>
                                {{ $tag->name }}
                            </td>
                            <td>
                                {{ $tag->posts->count() }}
                            </td>
                            <td>
                                <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <a href="#" class="btn btn-danger btn-sm"
                                   onclick="displayModelForm({{$tag}})"
                                   data-toggle="modal" data-target="#deleteModal">Delete</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

  <!-- Delete Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Delete</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>

        <form action="" method="Post" id="deleteForm">
            @csrf
            @method('DELETE')
            <div class="modal-body">
                <p>Are You Sure Want To Delete Tag</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Delete Tag</button>
            </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Delete Modal -->

@endsection


@section('page-level-scripts')

  <script type="text/javascript">
    function displayModelForm($tag) {
        $('#deleteForm').attr('action', '/tags/' + $tag.id);
    }
  </script>

@endsection
