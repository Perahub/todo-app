import { Component, Input, OnInit } from '@angular/core';
import { ModalController, ToastController } from '@ionic/angular';
import { TodoService, ITodo, Todo } from 'src/app/services/todo.service';

@Component({
  selector: 'app-form-todo',
  templateUrl: './form-todo.page.html',
  styleUrls: ['./form-todo.page.scss'],
})
export class FormTodoPage implements OnInit {
  @Input() model: ITodo = new Todo({
    id: null,
    created_by: null,
    date: null,
    isFinished: null,
    title: null
  });
  @Input() isNew: boolean = true;
  
  constructor(
    private xhrTodo: TodoService,
    private toastController: ToastController,
    private modalController: ModalController
  ) {

  }

  ngOnInit() {
    this.model = new Todo(this.model);
  }

  onSubmit() {
    this.xhrTodo.upsertTodo(this.model).subscribe(
      async () => {
        const toast = await this.toastController.create({
          message: `Todo sucesfully ${this.isNew ? 'created' : 'edited'}`,
          duration: 2000
        });
        toast.present();
        this.modalController.dismiss(true);
      },
      async (e) => {
        console.log(e);
        const toast = await this.toastController.create({
          message: e.error.error,
          duration: 2000
        });
        toast.present();
      }
    );
  }

}
