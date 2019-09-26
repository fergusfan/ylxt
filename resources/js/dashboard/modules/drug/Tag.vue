<template>
  <div class="row">
    <vue-table :title="药箱列表" :fields="fields" api-url="drug" show-paginate @table-action="tableActions">
      <template slot="buttons">
        <router-link :to="{ name: 'dashboard.drug.create' }" class="btn btn-sm btn-success" v-if="checkPermission('CREATE_TAG')">{{ $t('page.create') }}</router-link>
      </template>
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
          name: 'name',
          trans: '药品名称'
        }, {
          name: 'type',
          trans: '产品类别'
        },
          {
              name: 'price',
              trans: '价格'
          },{
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
        this.$router.push({ name: 'dashboard.drug.edit', params: { id: data.id } })
      } else if (action == 'delete-item') {
        this.$http.delete('drug/' + data.id)
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
