@extends('Layout/user/main')

@section('content')
  <div class="container mt-4">
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    Images List
    <ul class="list-group">
      @if(count($images) > 0)
        @foreach($images as $image)
          <li class="list-group-item d-flex justify-content-between align-items-center">
            <img src="{{ asset('storage/' . $image->file_name) }}" alt="Image" class="img-thumbnail" style="max-width: 100px; max-height: 100px;">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#imageViewModal{{ $image->id }}">
              View
            </button>
            <form action="/user/images/{{ $image->id }}" method="post">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger">Delete</button>
            </form>
          </li>

          <!-- Modal for image view -->
          <div class="modal fade" id="imageViewModal{{ $image->id }}" tabindex="-1" role="dialog" aria-labelledby="imageViewModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="imageViewModalLabel">Image View</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <img src="{{ asset('storage/' . $image->file_name) }}" alt="Image" style="max-width: 100%; max-height: 100%;">
                </div>
              </div>
            </div>
          </div>
        @endforeach
      @else
        <div>No Image Found</div>
      @endif
    </ul>
  </div>
@endsection

<!-- Include Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

</body>
</html>
