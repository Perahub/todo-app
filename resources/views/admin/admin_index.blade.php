@extends("layouts.admin")
@section('title', "Home")
@section("content")
    
    <div class="container pt-5">
            <h1 class="text-center">Deleted Todo's</h1>
            <div class="btn-group">
            </div>
            <div class="row">
            <div class="col-lg-12 d-flex justify-content-center table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle text-center">Title</th>
                        <th class="align-middle text-center">Date</th>
                        <th class="align-middle text-center">Completed</th>
                        <th class="align-middle text-center">Created By</th>
                        <th class="align-middle text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $index => $activity)
                <tr>
                        <td class="align-middle text-center">{{$activity->title}}</td>
                        <td class="align-middle text-center">{{$activity->activity_date}}</td>                    
                        <td class="align-middle text-center">Not Completed</td>                    
                        <td class="align-middle text-center">{{$activity->user->name}}</td>                    
                        <td class="text-center">

                           

                            <button type="button" class="btn btn-warning" data-title="{{$activity->title}}" data-resid={{$activity->id}}  data-toggle="modal" data-target="#restore">Restore</button>

                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center">No items to show!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        {{ $activities->links() }}
    </div>

                            <div id="restore" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/restore-activity" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you sure you want to restore this Activity?</h4>
                                            </div>
                                            <input type="hidden" name="restore_id" id="res_id" value="">
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Restore</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                          </form>
                                    </div>
                                </div>
                            </div>                                              
                    </div>
 @endsection

@section('script')

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>


<script type="text/javascript">
    $('#restore').on('show.bs.modal', function (event){
        var button = $(event.relatedTarget)

        var res_id = button.data('resid')
        var modal = $(this)


        modal.find('#res_id').val(res_id);

    })
</script>

</body>
@endsection
            







