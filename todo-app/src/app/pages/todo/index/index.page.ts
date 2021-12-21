import { Component, OnInit } from '@angular/core';
import { AlertController, ModalController, ToastController } from '@ionic/angular';

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
  todos: ITodo[] = [];
  public form = [
    { val: 'Pepperoni', isChecked: true },
    { val: 'Sausage', isChecked: false },
    { val: 'Mushroom', isChecked: false }
  ];
  constructor(
    private xhrTodos: TodoService,
    private modalController: ModalController,
    private toastController: ToastController,
    private alertController: AlertController,
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

  async deleteTodos() {
    const alert = await this.alertController.create({
      header: 'Are you sure?',
      // subHeader: 'Subtitle',
      message: `Delete all To Do?`,
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            return this.xhrTodos.deleteAllTodo().subscribe(async (e) => {
              const toast = await this.toastController.create({
                message: `Todo sucesfully deleted`,
                duration: 2000
              });
              this.getTodos();
            })
          }
        },{
          text: 'No'
        }
      ]
    });

    await alert.present();
  }

}
