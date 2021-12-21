import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { IonicModule } from '@ionic/angular';

import { FormTodoPageRoutingModule } from './form-todo-routing.module';

import { FormTodoPage } from './form-todo.page';

@NgModule({
  imports: [
    CommonModule,
    FormsModule,
    IonicModule,
    FormTodoPageRoutingModule
  ],
  declarations: [FormTodoPage]
})
export class FormTodoPageModule {}
