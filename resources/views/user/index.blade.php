@extends("layouts.user")
@section('title', "Home")
@section("content")
    
    <div class="container pt-5">
            <h1 class="text-center">{{Auth::user()->name}}'s Todo's</h1>
            <div class="btn-group">
                <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#create">Create</button>
            <form action="/user/destroy" method="POST">
                @csrf
                @method("DELETE")
                <button class="btn btn-danger">Delete All</button>
            </form>
            </div>
            <div class="row">
            <div class="col-lg-12 d-flex justify-content-center table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th class="align-middle text-center">Title</th>
                        <th class="align-middle text-center">Date</th>
                        <th class="align-middle text-center">Completed</th>
                        <th class="align-middle text-center">Action</th>

                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $index => $activity)
                <tr>
                         @if($activity->isFinished === 0)
                        <td class="align-middle text-center">{{$activity->title}}</td>
                        <td class="align-middle text-center">{{$activity->activity_date}}</td>                    
                        <td class="align-middle text-center">Not Completed</td>                    
                        <td class="text-center">

                            <button type="button" class="btn btn-success" data-done_ticid={{$activity->id}} data-toggle="modal" data-target="#mark_done">Finished</button>

                            <button type="button" class="btn btn-secondary" data-title="{{$activity->title}}" data-edit_ticid={{$activity->id}} data-date={{$activity->activity_date}} data-toggle="modal" data-target="#edit">Edit</button>

                            <button type="button" class="btn btn-danger" data-ticid={{$activity->id}} data-toggle="modal" data-target="#delete">Delete</button>
                        </td>
                            <!-- Modal -->
                

                               
                            </td>
                            @elseif($activity->isFinished === 1)
                            <td class="align-middle text-center" style="background-color:gray;">{{$activity->title}}</td>
                        <td class="align-middle text-center" style="background-color:gray;">{{$activity->activity_date}}</td>                     
                        <td class="align-middle text-center" style="background-color:gray;">Completed</td>                     
                        <td class="text-center" style="background-color:gray;">
                            <button type="button" class="btn btn-warning" data-done_ticid={{$activity->id}} data-toggle="modal" data-target="#mark_undone">Mark as Undone</button>
                           <button disabled type="button" class="btn btn-secondary" data-title={{$activity->title}} data-edit_ticid={{$activity->id}} data-date={{$activity->activity_date}} data-toggle="modal" data-target="#edit">Edit</button>
                            <button type="button" class="btn btn-danger" data-ticid={{$activity->id}} data-toggle="modal" data-target="#delete">Delete</button>
                        </td>
                            @endif
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
                        <div id="delete" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/user/destroy-activity" method="POST">
                                            @csrf
                                            @method("DELETE")
                                            <div class="modal-header">
                                                <h4 class="modal-title">Warning</h4>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete this Activity?</p>
                                                <input type="hidden" name="activity_id" id="tic_id" value="">
                                            </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-danger">Delete</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                          </form>
                                    </div>
                                </div>
                            </div>

                            <div id="create" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/user" method="POST">
                                            @csrf
                                            <div class="modal-header">
                                                <h4 class="modal-title">Create Activity</h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                                  <div class="row">
                                                    <div class="col">
                                                         <input type="text" class="form-control" placeholder="Activity Title" id="title" name="title" required>
                                                     </div>
                                                     <div class="col">
                                                        <input type="date" class="form-control" id="date" name="date" required>
                                                    </div>
                                                    
                                                 </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Create</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                          </form>
                                    </div>
                                </div>
                            </div>

                            <div id="edit" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/user/update-activity" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <div class="modal-header">
                                                <h4 class="modal-title">Edit Activity</h4>
                                            </div>
                                            <div class="modal-body">
                                                
                                                  <div class="row">
                                                    <div class="col">
                                                         <input type="text" class="form-control" placeholder="Activity Title" id="edit_title" name="title" value="" required>
                                                     </div>
                                                     <div class="col">
                                                        <input type="date" class="form-control" id="edit_date" name="date" required>
                                                    </div>
                                                    <input type="hidden" name="activity_id" id="edit_tic_id" value="">
                                                 </div>
                                            </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Save</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                          </form>
                                    </div>
                                </div>
                            </div>

                              <div id="mark_done" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/user/done" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <div class="modal-header">
                                                <h4 class="modal-title">Are you finished with this Activity?</h4>
                                            </div>
                                
                                                
                                                    <input type="hidden" name="activity_id" id="done_tic_id" value="">
                                                 
                                            
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Yes</button>
                                                    <button class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                </div>
                                          </form>
                                    </div>
                                </div>
                            </div>

                             <div id="mark_undone" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <form action="/user/undone" method="POST">
                                            @csrf
                                            @method("PATCH")
                                            <div class="modal-header">
                                                <h4 class="modal-title">Mark this activity as Undone?</h4>
                                            </div>
                                
                                                
                                                    <input type="hidden" name="activity_id" id="done_tic_id" value="">
                                                 
                                            
                                                <div class="modal-footer">
                                                    <button class="btn btn-success">Yes</button>
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
    $(document).ready(function () {
        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });
    });
</script>
<script type="text/javascript">
    $('#delete').on('show.bs.modal', function (event){
        var button = $(event.relatedTarget)

        var tic_id = button.data('ticid')
        var modal = $(this)
        console.log(button);
        console.log(tic_id);
        console.log(modal);

        modal.find('.modal-body #tic_id').val(tic_id);

    })
</script>

<script type="text/javascript">
    $('#edit').on('show.bs.modal', function (event){

        console.log("modal opened");
        var button = $(event.relatedTarget)
        var title = button.data("title")
        var date = button.data("date")
        var ticid = button.data("edit_ticid")
        var modal = $(this)


        modal.find('.modal-body #edit_title').val(title);
        modal.find('.modal-body #edit_date').val(date);
        modal.find('.modal-body #edit_tic_id').val(ticid);

    })
</script>

<script type="text/javascript">
    $('#mark_done').on('show.bs.modal', function (event){

        console.log("modal opened");
        var button = $(event.relatedTarget)
        var ticid = button.data("done_ticid")
        var modal = $(this)

        modal.find('#done_tic_id').val(ticid);

    })
</script>

<script type="text/javascript">
    $('#mark_undone').on('show.bs.modal', function (event){

        console.log("modal opened");
        var button = $(event.relatedTarget)
        var ticid = button.data("done_ticid")
        var modal = $(this)

        modal.find('#done_tic_id').val(ticid);

    })
</script>

</body>
@endsection
            







