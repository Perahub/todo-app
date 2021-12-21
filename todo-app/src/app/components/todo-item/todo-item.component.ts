import { Component, EventEmitter, Input, OnInit, Output } from '@angular/core';
import { AlertController, ModalController, ToastController } from '@ionic/angular';
import { ITodo, TodoService } from 'src/app/services/todo.service';

import { FormTodoPage } from "../../modals/form-todo/form-todo.page";

@Component({
  selector: 'app-todo-item',
  templateUrl: './todo-item.component.html',
  styleUrls: ['./todo-item.component.scss'],
})
export class TodoItemComponent implements OnInit {
  @Input() todo: ITodo;
  @Output() requestReload = new EventEmitter<string>();
  modalForm: HTMLIonModalElement;
  constructor(
    private modalController: ModalController,
    private alertController: AlertController,
    private xhrTodo: TodoService,
    private toastController: ToastController,
  ) {
  }

  ngOnInit() {}

  async openEdit () {
    this.modalForm = await this.modalController.create({
      component: FormTodoPage,
      componentProps: {
        'isNew' : true,
        'model': this.todo
      }
    });

    await this.modalForm.present();
    const { data } = await this.modalForm.onWillDismiss();
    if(data == true) {
      this.requestReload.emit();
    }
  }

  async deleteItem() {
    const alert = await this.alertController.create({
      header: 'Are you sure?',
      // subHeader: 'Subtitle',
      message: `Delete ${this.todo.title}`,
      buttons: [
        {
          text: 'Yes',
          handler: () => {
            return this.xhrTodo.deleteTodo(this.todo.id).subscribe(async () => {
              const toast = await this.toastController.create({
                message: `Todo sucesfully deleted`,
                duration: 2000
              });
              toast.present();
              this.requestReload.emit();
            });
          }
        },{
          text: 'No'
        }
      ]
    });

    await alert.present();
  }
}
