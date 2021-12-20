@extends('layouts.app')

@section('content')
  @php
    date_default_timezone_set('Asia/Manila');
  @endphp
  <div class="content-wrapper container">
    <div class="row">
      <div class="col-lg-12">
        <div class="card mt-2">
          <div class="card-header text-right">
            <button
              data-toggle="modal"
              data-target="#add_todo"
              type="button"
              class="btn blue"
              name="button">
              <i class="fas fa-plus-square"></i>
            </button>

            <button
              data-type="multi"
              type="button"
              class="btn btn-delete-all hidden red"
              name="button">
              <i class="fas fa-trash-alt"></i>
            </button>
          </div>
          <div class="card-body">
            <div class="container">
              <div class="row">

                @foreach ($get_todos as $todo)
                  <div class="col-lg-3">
                    <div class="card text-white todo-card-{{$todo->id}} {{($todo->status == "active") ? "bg-info" : "bg-success"}}">
                      <div class="card-header">
                        <h2 class="float_left">{{ucwords($todo->title)}}</h2>
                        <input
                          type="checkbox"
                          class="form-control todo-checkbox float_right"
                          value="{{$todo->id}}">
                      </div>
                      <div class="card-body todo-card-body">
                        <span class="text-right">{{date("D, M j, Y - g:i a", strtotime($todo->created_at))}}</span>
                        <hr><br>
                        <span class="{{($todo->status == "active") ? "" : "done"}}">{{$todo->description}}</span>
                      </div>
                      <div style="height: 70px;" class="card-footer text-center">
                        @if ($todo->status == "active")
                          <button
                            data-id="{{$todo->id}}"
                            type="button"
                            class="btn btn-done green"
                            name="button">
                            <i class="fas fa-check"></i>
                          </button>

                          <button
                            data-toggle="modal"
                            data-target="#edit_todo_{{$todo->id}}"
                            type="button"
                            class="btn btn-edit orange"
                            name="button">
                            <i class="fas fa-edit"></i>
                          </button>

                          <button
                            data-type="single"
                            data-id="{{$todo->id}}"
                            type="button"
                            class="btn btn-delete red"
                            name="button">
                            <i class="fas fa-trash-alt"></i>
                          </button>
                        @else
                          <h1>Task Completed</h1>
                          <small>{{date("D, M j, Y - g:i a", strtotime($todo->completed_date))}}</small>
                        @endif
                      </div>
                    </div>
                  </div>
                @endforeach

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="add_todo" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Task</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-lg-12">
              <div class="col-lg-12">
                <label>Date</label>
                <input
                  type="text"
                  class="form-control"
                  name="todo_date" value="{{date("D, M j, Y - g:i a")}}"
                  readonly><br>
              </div>
            </div>
            <div class="col-lg-12">
              <label>Title</label>
              <input
                type="text"
                class="form-control required_fields"
                name="todo_title"><br>
            </div>
            <div class="col-lg-12">
              <label>Description</label>
              <textarea
                name="todo_desc"
                class="form-control required_fields"
                rows="4"></textarea>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn red" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-save blue">Add</button>
        </div>
      </div>
    </div>
  </div>

  @foreach ($get_todos as $todo)
    <div class="modal fade" id="edit_todo_{{$todo->id}}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="col-lg-12">
                  <label>Date</label>
                  <input type="hidden" name="todo_id" class="edit_fields_{{$todo->id}}" value="{{$todo->id}}">
                  <input
                    type="text"
                    class="form-control"
                    name="todo_date" value="{{date("D, M j, Y - g:i a", strtotime($todo->created_at))}}"
                    readonly><br>
                </div>
              </div>
              <div class="col-lg-12">
                <label>Title</label>
                <input
                  type="text"
                  class="form-control edit_fields_{{$todo->id}}"
                  name="todo_title"
                  value="{{ucwords($todo->title)}}"><br>
              </div>
              <div class="col-lg-12">
                <label>Description</label>
                <textarea
                  name="todo_desc"
                  class="form-control edit_fields_{{$todo->id}}"
                  rows="4">{{ucwords($todo->description)}}</textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
            <button data-id="{{$todo->id}}" type="button" class="btn btn-save-edit blue">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  @endforeach

@endsection


@section('scripts')
  <script src="{{asset("js/todo.js")}}" charset="utf-8"></script>
@endsection





























{{--  --}}
