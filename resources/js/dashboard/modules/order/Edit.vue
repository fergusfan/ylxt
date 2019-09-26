<template>
  <vue-form :title="挂号管理">
    <template slot="buttons">
      <router-link :to="{ name: 'dashboard.tag' }" class="btn btn-sm btn-secondary" exact>{{ $t('form.back') }}</router-link>
    </template>
    <template slot="content">
      <tag-form :tag="tag"></tag-form>
    </template>
  </vue-form>
</template>

<script>
import TagForm from './Form'

export default {
  components: { TagForm },
  data() {
    return {
      tag: undefined
    }
  },
  created() {
    this.loadTag()
  },
  methods: {
    loadTag() {
      this.$http.get('order/' + this.$route.params.id + '/edit')
        .then((response) => {
          this.tag = response.data.data
        })
    },
  }
}
</script>
