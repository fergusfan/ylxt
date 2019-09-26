<template>
  <vue-form :title="创建药品">
    <template slot="buttons">
      <router-link :to="{ name: 'dashboard.tag' }" class="btn btn-sm btn-secondary" exact>{{ $t('form.back') }}</router-link>
    </template>
    <template slot="content">
      <tag-form></tag-form>
    </template>
  </vue-form>
</template>

<script>
import TagForm from './Form'

export default {
  components: { TagForm },
}
</script>
