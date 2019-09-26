<template>
  <div class="row">
    <vue-table :title="挂号列表" :fields="fields" api-url="order" show-paginate @table-action="tableActions">
      <!--<template slot="buttons">-->
        <!--<router-link :to="{ name: 'dashboard.order.create' }" class="btn btn-sm btn-success" v-if="checkPermission('CREATE_TAG')">{{ $t('page.create') }}</router-link>-->
      <!--</template>-->
    </vue-table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      fields: [{
          name: 'id',
          trans: 'table.id',
          titleClass: 'width-5-percent text-center',
          dataClass: 'text-center'
        }, {
          name: 'order_time',
          trans: '预约时间'
        }, {
          name: 'user',
          trans: '用户'
        }, {
          name: 'department',
          trans: '挂号科室'
        },{
          name: 'order_replay',
          trans: '预约回复'
        }, {
          name: 'created_at',
          trans: 'table.created_at'
        }, {
          name: '__actions',
          trans: 'table.action',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ]
    }
  },
  methods: {
    tableActions(action, data) {
      if (action == 'edit-item') {
        this.$router.push({ name: 'dashboard.order.edit', params: { id: data.id } })
      } else if (action == 'delete-item') {
        this.$http.delete('order/' + data.id)
          .then((response) => {
            toastr.success('删除成功!')

            this.$emit('reload')
          }).catch(({ response }) => {
            toastr.error(response.status + ' : Resource ' + response.statusText)
          })
      }
    }
  }
}
</script>
