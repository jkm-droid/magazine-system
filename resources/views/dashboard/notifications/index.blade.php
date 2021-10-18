@extends('base.admin_index')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Notifications</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><b>Notifications</b></li>
                        <li class="breadcrumb-item active"><b>All</b></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    @if($notifications->isEmpty())
        <h4 class="text-center">No notification found.</h4>
    @else
        <div class="col-12">
            <div class="card card-outline card-warning">
                <!-- /.card-header -->
                <div class="card-body m-1 table-responsive p-0">

                    @foreach($notifications as $notification)

                        <div class="notifications card card-outline m-2 " style="padding: 5px;">
                            <p>
                                {{ $notification->created_at }}<br>
                                A new article <strong>"{{ $notification->data['title'] }}"</strong> was added by <strong>{{ $notification->data['author'] }}</strong>
                                <button class="btn badge badge-danger right" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Publish</button>
                                <button class="btn badge badge-success right" id="mark-as-read" data-id="{{ $notification->id }}">mark as read</button>
                            </p>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-danger" id="staticBackdropLabel">{{ $notification->data['title'] }}</h5>
                                        <i data-bs-dismiss="modal" aria-label="Close" class="fa fa-times"></i>
                                    </div>
                                    <input type="hidden" value="{{ $notification->data['article_id'] }}" id="article-id">
                                    <div class="modal-body">
                                        <p>{!! $notification->data['body'] !!}</p>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="button" article-id="{{ $notification->data['article_id']  }}" id="publish-article" class="btn btn-success">Publish</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    @endforeach
                    <a href="#" id="mark-all-as-read" class="btn btn-sm btn-info ml-2">Mark all as Read</a>
                </div>
                <!-- /.card-body -->
                <script>
                    $(document).on('click', '#mark-as-read', function (e) {
                        e.preventDefault();
                        var notification_id = $(this).attr('data-id');

                        $.ajax({
                            url: '{{ url('notifications/mark_as_read')}}/'+notification_id,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'notification_id' : notification_id,
                            },
                            success: function (response) {
                                if(response.status === 200){
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true
                                        }
                                    toastr.success("Marked as read");
                                    $(this).parents('div.notifications').remove();
                                }else{
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true
                                        }
                                    toastr.error("Oops! An error occurred");
                                }
                            },

                            failure: function (response) {
                                console.log("something went wrong");
                            }
                        });
                    });
                </script>
                <script>
                    $(document).on('click', 'button[article-id]', function (e) {
                        e.preventDefault();
                        var article_id = $('#article-id').val();
                        console.log(article_id);

                        $.ajax({
                            url: '{{ url('notifications/publish/ajax')}}/'+article_id,
                            type: 'POST',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                'article_id' : article_id,
                            },
                            success: function (response) {
                                if(response.status === 200){
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true
                                        }
                                    toastr.success("Article published successfully");
                                    $(this).parents('div.notifications').remove();
                                    window.location.reload();
                                }else{
                                    toastr.options =
                                        {
                                            "closeButton" : true,
                                            "progressBar" : true
                                        }
                                    toastr.error("Oops! An error occurred");

                                }
                            },

                            failure: function (response) {
                                console.log("something went wrong");
                            }
                        });
                    });
                </script>
            </div>
            <!-- /.card -->
        </div>

    @endif


@endsection
