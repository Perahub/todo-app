export const routes = [
    {
        path: '/',
        name: 'login',
        component: () => import('./components/LoginComponents.vue')
    },
    {
        path: '/todo',
        name: 'todo',
        component: () => import('./components/Todo.vue')
    },
    {
        path: '/edit-todo/:id',
        name: 'edit-todo',
        component: () => import('./components/EditTodo.vue')
    }
]

