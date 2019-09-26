<template>
  <div class="row">
    <form class="col-md-4 offset-md-4" role="form" @submit.prevent="onSubmit">
      <div class="form-group">
        <label for="tag">用户</label>
        <input type="text" class="form-control" id="tag" :placeholder="用户" name="user" v-model="tag.user" >
      </div>
      <div class="form-group">
        <label for="title">时间</label>
        <input type="text" class="form-control" id="title" :placeholder="时间" name="title" v-model="tag.order_time">
      </div>
      <div class="form-group">
        <label for="title">挂号科室</label>
        <input type="text" class="form-control" id="title" :placeholder="挂号科室" name="title" v-model="tag.department">
      </div>
      <div class="form-group">
        <label for="title">回复预约</label>
        <input type="text" class="form-control" id="title" :placeholder="挂号科室" name="title" v-model="tag.order_replay">
      </div>
      <div class="form-group">
        <label for="meta_description">病情描述</label>
        <textarea class="form-control" name="meta_description" id="meta_description" :placeholder="病情描述" v-model="tag.description"></textarea>
      </div>
      <div class="form-group">
        <button type="submit" class="btn btn-info">{{ tag.id ? $t('form.edit') : $t('form.create') }}</button>
      </div>
    </form>
  </div>
</template>

<script>
import { stack_error } from 'config/helper'

export default {
  props: {
    tag: {
      type: Object,
      default () {
        return {}
      }
    }
  },
  computed: {
    mode() {
      return this.tag.id ? 'update' : 'create'
    },
  },
  methods: {
    onSubmit() {
      let url = 'order' + (this.tag.id ? '/' + this.tag.id : '')
      let method = this.tag.id ? 'patch' : 'post'

      this.$http[method](url, this.tag)
        .then((response) => {
          toastr.success('You ' + this.mode + 'd the tag success!')

          this.$router.push({ name: 'dashboard.order' })
        }).catch(({ response }) => {
          stack_error(response)
        })
    }
  },
}
</script>
