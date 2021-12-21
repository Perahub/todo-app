import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { FormTodoPage } from './form-todo.page';

const routes: Routes = [
  {
    path: '',
    component: FormTodoPage
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule],
})
export class FormTodoPageRoutingModule {}
