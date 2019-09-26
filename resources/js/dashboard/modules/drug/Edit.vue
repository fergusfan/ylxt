<template>
  <vue-form :title="编辑药品">
    <template slot="buttons">
      <router-link :to="{ name: 'dashboard.article' }" class="btn btn-sm btn-secondary" exact>{{ $t('form.back') }}</router-link>
    </template>
    <template slot="content">
      <article-form :article="article"></article-form>
    </template>
  </vue-form>
</template>

<script>
    import ArticleForm from './Form'

    export default {
        components: { ArticleForm },
        data() {
            return {
                article: undefined
            }
        },
        created() {
            this.$http.get('drug/' + this.$route.params.id + '/edit')
                .then((response) => {
                    this.article = response.data.data
                })
        },
    }
</script>
