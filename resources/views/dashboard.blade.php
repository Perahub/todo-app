@extends('layouts.app')

@section('content')
  @if ($get_role == "admin")
    <div class="content-wrapper container">
      <div class="row">
        <div class="col-lg-12">
          <div class="card mt-2">
            <div class="card-header">
              <h1>Users Table</h1>
            </div>
            <div class="card-body">
              <div class="container">
                <div class="row">
                  <div class="col-lg-12">
                    <table class="table table-striped table-hover datatable">
                      <thead>
                        <tr>
                          <th>Email</th>
                          <th>Role</th>
                          <th>Date Created</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($get_users as $user)
                          <tr>
                            <td>{{$user->email}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->created_at}}</td>
                            <td>
                              <button
                                data-toggle="modal"
                                data-target="#assign_modal_{{$user->id}}"
                                type="button"
                                class="btn blue"
                                name="button">
                                Assign Task
                              </button>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="content-wrapper container">
      <div class="row">
        <div class="col-lg-12 text-center">
          <div class="card">
            <div class="card-body">
              <div class="jumbotron">
                <h1 class="display-4">Hello, {{ucwords($get_role)}}!</h1><br>
                <p class="lead">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                <hr class="my-2">
                <p> Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p><br>
                <p class="lead">
                  <a class="btn btn-primary btn-lg" href="#" role="button">Lorem ipsum</a>
                </p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif


  @foreach ($get_users as $user)
    <div class="modal fade" id="assign_modal_{{$user->id}}" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Asign Task</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-lg-12">
                <div class="col-lg-12">
                  <label>Date</label>
                  <input type="hidden" class="required_fields_{{$user->id}}" name="todo_user" value="{{$user->id}}">
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
                  class="form-control required_fields_{{$user->id}}"
                  name="todo_title"><br>
              </div>
              <div class="col-lg-12">
                <label>Description</label>
                <textarea
                  name="todo_desc"
                  class="form-control required_fields_{{$user->id}}"
                  rows="4"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn red" data-dismiss="modal">Close</button>
            <button data-id="{{$user->id}}" type="button" class="btn btn-assign blue">Assign</button>
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
