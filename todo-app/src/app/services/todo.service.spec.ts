import { HttpEvent } from '@angular/common/http';
import { TestBed } from '@angular/core/testing';

import { TodoService } from './todo.service';

describe('TodoService', () => {
  let service: TodoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(TodoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });

  it('Can fetch all todos', () => {
    // expect(service.getTodos().).toBeTruthy();
    // service.getTodos().subscribe((event: HttpEvent<any>) => {
    // });
  });
  
});
