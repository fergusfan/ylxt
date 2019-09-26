export default [{
  path: 'order',
  component: () => import('js/App.vue'),
  children: [{
    path: '/',
    name: 'dashboard.order',
    component: () => import('./Tag')
  }, {
    path: 'create',
    name: 'dashboard.order.create',
    component: () => import('./Create')
  }, {
    path: ':id/edit',
    name: 'dashboard.order.edit',
    component: () => import('./Edit')
  }]
}]
