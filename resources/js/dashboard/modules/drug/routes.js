export default [{
  path: 'drug',
  component: () => import('js/App.vue'),
  children: [{
    path: '/',
    name: 'dashboard.drug',
    component: () => import('./Tag')
  }, {
    path: 'create',
    name: 'dashboard.drug.create',
    component: () => import('./Create')
  }, {
    path: ':id/edit',
    name: 'dashboard.drug.edit',
    component: () => import('./Edit')
  }]
}]
