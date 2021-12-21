import { Component, OnInit } from '@angular/core';
import { ModalController } from '@ionic/angular';

import { ITodo, TodoService } from "../../../services/todo.service";
import { FormTodoPage } from "../../../modals/form-todo/form-todo.page";

@Component({
  selector: 'app-index',
  templateUrl: './index.page.html',
  styleUrls: ['./index.page.scss'],
})
export class IndexPage implements OnInit {
  isLoading: boolean = false;
  modalForm: HTMLIonModalElement;
  todos: ITodo[];
  public form = [
    { val: 'Pepperoni', isChecked: true },
    { val: 'Sausage', isChecked: false },
    { val: 'Mushroom', isChecked: false }
  ];
  constructor(
    private xhrTodos: TodoService,
    private modalController: ModalController,
  ) { }

  ngOnInit() {
    this.getTodos()
  }

  getTodos() {
    this.xhrTodos.getTodos().subscribe((e) => {
      this.todos = e
    },() => {
      this.isLoading = false;
    },() => {
      this.isLoading = false;
    });
  }

  async openCreate () {
    this.modalForm = await this.modalController.create({
      component: FormTodoPage,
      componentProps: {
        'isNew' : true
      }
    });

    await this.modalForm.present();
    const { data } = await this.modalForm.onWillDismiss();
    if(data == true) {
      this.getTodos();
    }
  }

}
