import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http'; 
import { environment } from '../../environments/environment';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class TodoService {

  constructor(
    private xhr: HttpClient,
  ) { }

  getTodos() : Observable<ITodo[]> {
    return this.xhr.get<ITodo[]>(
      environment.api + 'todos',
      {
        params: {
        }
      }
    );
  }

  deleteTodo(id: number) : Observable<any> {
    return this.xhr.delete(
      environment.api + 'todo/' + id,
    )
  }

  deleteAllTodo() : Observable<any> {
    return this.xhr.delete(
      environment.api + 'todos',
    )
  }

  public upsertTodo (todo: ITodo) {
    // console.log(user);
    if(todo.id)
      return this.xhr.patch(environment.api + 'todo/' + todo.id, todo)
    else
      return this.xhr.post(environment.api + 'todo', todo)
  }
}

export interface ITodo {
  id: number,
  created_by: number
  title: string,
  date: string,
  is_finished: boolean,
}

export class Todo implements ITodo {
  id: number;
  created_by: number;
  title: string;
  date: string;
  is_finished: boolean;
  constructor(obj: ITodo) {
    this.id = obj.id;
    this.created_by = obj.created_by;
    this.title = obj.title;
    this.date = obj.date;
    this.is_finished = obj.is_finished;    
  }
}