<template>
  <div class="row">
    <form class="col-sm-9 offset-sm-1" @submit.prevent="onSubmit">
      <div class="col-sm-12">
        <div class="form-group row">
          <label for="title" class="col-sm-2 col-form-label">药品名</label>
          <div class="col-sm-10">
            <input type="text" id="title" name="title" v-model="article.name" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">价格</label>
          <div class="col-sm-10">
            <input type="text" id="subtitle" name="subtitle" v-model="article.price" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">产品类别</label>
          <div class="col-sm-10">
            <input type="text" id="subtitle" name="subtitle" v-model="article.type" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">供应商</label>
          <div class="col-sm-10">
            <input type="text" id="subtitle" name="subtitle" v-model="article.provider" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">成分</label>
          <div class="col-sm-10">
            <input type="text" id="subtitle" name="subtitle" v-model="article.has" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">用法用量</label>
          <div class="col-sm-10">
            <input type="text" id="subtitle" name="subtitle" v-model="article.use" class="form-control">
          </div>
        </div>
        <div class="form-group row">
          <label for="page_image" class="col-sm-2 col-form-label">{{ $t('form.page_image') }}</label>
          <div class="col-sm-5">
            <input type="text" id="page_image" class="form-control" name="page_image" v-model="article.img"
                   placeholder="ex: /uploads/default_avatar.png">
          </div>
          <div class="col-sm-5">
            <img v-if="article.page_image != null && article.page_image != ''" :src="article.page_image" alt="Pig Jian" width="35" height="35">
            <div class="cover-upload pull-right">
              <a href="javascript:;" class="btn btn-success file">
                <span>{{ $t('form.upload_file') }}</span>
                <input type="file" @change="coverUploader">
              </a>
            </div>
          </div>
        </div>
        <div class="form-group row">
          <label for="subtitle" class="col-sm-2 col-form-label">功能主治</label>
          <div class="col-sm-10">
            <textarea  id="subtitle" name="subtitle" v-model="article.description" class="form-control"></textarea>
          </div>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="form-group row">
          <div class="offset-sm-2 col-sm-10">
            <button type="submit" class="btn btn-info">{{ article.id ? $t('form.edit') : $t('form.create') }}</button>
          </div>
        </div>
      </div>
    </form>
  </div>
</template>

<script>
    import FormMixin from './FormMixin'
    // import { default as SimpleMDE } from 'simplemde/dist/simplemde.min'
    import E from 'simplemde/dist/wangEditor.min'
    import Multiselect from 'vue-multiselect'
    import { stack_error } from 'config/helper'
    import DatePicker from 'vue-datepicker'
    import FineUploader from 'fine-uploader/lib/traditional'
    import emojione from 'emojione'

    export default {
        mixins: [FormMixin],
        components: {
            Multiselect,
            DatePicker
        },
        props: {
            article: {
                type: Object,
                default () {
                    return {
                        page_image: ''
                    }
                }
            }
        },
        data () {
            return {
                simplemde: '',
                editorContent: '',
                content: '',
            }
        },
        computed: {
            mode () {
                return this.article.id ? 'update' : 'create'
            },
        },
        watch: {
            article () {
                // this.selected = this.article.category.data
                // this.tags = this.article.tags.data
                // this.simplemde.value(this.article.content)
                // this.startTime.time = this.article.published_time
            }
        },
        mounted () {
            var editor = new E(this.$refs.editor)
            editor.customConfig.uploadImgShowBase64 = true
            editor.customConfig.onchange = (html) => {
                this.editorContent = html
            }
            editor.create()
            // let t = this.$t || this.$i18n.t
            // let self = this
            //
            // this.simplemde = new SimpleMDE({
            //   element: document.getElementById('editor'),
            //   placeholder: t('form.content_placeholder', {type: t('form.article')}),
            //   autoDownloadFontAwesome: true,
            //   forceSync: true,
            //   previewRender (plainText, preview) {
            //     preview.className += ' markdown'
            //
            //     return self.parse(plainText)
            //   },
            // })
            //
            // this.contentUploader()
        },
        methods: {
            parse (content) {
                marked.setOptions({
                    highlight: (code) => {
                        return hljs.highlightAuto(code).value
                    },
                    sanitize: true
                })

                return emojione.toImage(marked(content))
            },
            onSubmit () {
                // if (!this.tags || !this.selected) {
                //   toastr.error('Category and Tag must select one or more.')
                //   return
                // }

                // let tagIDs = []
                let url = 'drug' + (this.article.id ? '/' + this.article.id : '')
                let method = this.article.id ? 'patch' : 'post'

                // for (var i = 0; i < this.tags.length; i++) {
                //   tagIDs[i] = this.tags[i].id
                // }

                this.article.published_at = this.startTime.time
                this.article.content = this.editorContent
                // this.article.category_id = this.selected.id
                // this.article.tags = JSON.stringify(tagIDs)

                this.$http[method](url, this.article)
                    .then((response) => {
                        toastr.success('You ' + this.mode + 'd the article success!')

                        this.$router.push({name: 'dashboard.drug'})
                    }).catch(({response}) => {
                    stack_error(response)
                })
            },
            coverUploader (event) {
                let files = event.target.files

                let formData = new FormData()

                formData.append('image', files[0])
                formData.append('strategy', 'cover')

                this.$http.post('file/upload', formData)
                    .then((response) => {
                        toastr.success('图片上传成功')

                        this.article.img = response.data.url
                        document.getElementById('page_image').value = response.data.url;
                        console.log(this.article.img)
                    }).catch(({response}) => {
                    if (response.data.error) {
                        toastr.error(response.data.error.message)
                    } else {
                        toastr.error(response.status + ' : Resource ' + response.statusText)
                    }
                })
            },
            contentUploader () {
                let vm = this

                this.simplemde.codemirror.on('paste', function (editor, event) {
                    if (event.clipboardData.types.indexOf('Files') >= 0) {
                        event.preventDefault()
                    }
                })

                let contentUploader = new FineUploader.FineUploaderBasic({
                    paste: {
                        targetElement: document.querySelector('.CodeMirror')
                    },
                    request: {
                        endpoint: '/api/file/upload',
                        inputName: 'image',
                        customHeaders: {
                            'X-CSRF-TOKEN': window.Laravel.csrfToken,
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        params: {
                            strategy: 'article'
                        }
                    },
                    validation: {
                        allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
                    },
                    callbacks: {
                        onPasteReceived (file) {
                            let promise = new FineUploader.Promise()

                            if (file == null || typeof file.type == 'undefined' || file.type.indexOf('image/')) {
                                toastr.error('Only can upload image!')
                                return promise.failure('not a image.')
                            }

                            return promise.then(() => {
                                vm.createdImageUploading('image.png')
                            }).success('image')
                        },
                        onComplete (id, name, responseJSON) {
                            vm.replaceImageUploading(name, responseJSON.url)
                        },
                    },
                })

                let dragAndDropModule = new FineUploader.DragAndDrop({
                    dropZoneElements: [document.querySelector('.CodeMirror')],
                    callbacks: {
                        processingDroppedFilesComplete (files, dropTarget) {
                            files.forEach((file) => {
                                vm.createdImageUploading(file.name)
                            })
                            contentUploader.addFiles(files) //this submits the dropped files to Fine Uploader
                        }
                    }
                })
            },
            getImageUploading () {
                return '\n![Uploading ...]()\n'
            },
            createdImageUploading (name) {
                this.simplemde.value(this.simplemde.value() + this.getImageUploading())
            },
            replaceImageUploading (name, url) {
                let result = '\n![' + name + '](' + url + ')\n'

                this.simplemde.value(this.simplemde.value().replace(this.getImageUploading(), result))
            },
        }
    }
</script>

<style lang="scss" scoped>
  .cover-upload {
    display: inline-block;

    .file {
      position: relative;
      margin: 0 auto;
      display: block;
      width: 100px;
      height: 35px;
      line-height: 35px;
      font-size: 12px;

      span {
        display: block;
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
      }
      input {
        position: absolute;
        left: 0;
        right: 0;
        top: 0;
        width: 100px;
        height: 35px;
        opacity: 0;
      }
    }
  }
</style>
