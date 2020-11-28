<template>
  <div>
    <div class="card" v-if="item">
      <div v-if="updated" class="alert alert-primary" role="alert">
          更新しました
      </div>
      <div class="card-body">
        <div v-if="!editFlg">
          <h1 class="card-title">{{item.title}}</h1>
          <div class="card-text">{{item.content}}</div>
          <div class="card-text">{{item.show_time}}</div>
        </div>
        <form v-else>
          <div class="form-group">
            <input type="text" name="title" id="TopicTitle" class="form-control" v-model="item.title">
          </div>
          <div class="form-group">
            <textarea name="content" id="TopicContent" class="form-control" v-model="item.content"></textarea>
          </div>
          <div class="form-group">
            <input type="datatime" name="show_time" id="TopicTime" class="form-control" v-model="item.show_time">
          </div>
        </form>
      </div>
      <div class="card-footer">
        <button class="btn btn-light text-right" v-if="!editFlg" @click="(editFlg = true)">編集</button>
        <button class="btn btn-light text-right" v-else @click="onUpdate">更新</button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
            item: null,
            editFlg: false,
            updated: false,
        }
    },
    mounted() {
        this.getItem();
    },
    methods: {
        getItem() {
            axios.get('/api/topics/' + this.$route.params.id)
            .then( ( res ) => {
                this.item = res.data.data;
            })
            .catch(error => {
              console.info(error)
            })
            console.log(this.item.show_time);
            console.log((typeof this.item.show_time) )
        },
        onUpdate() {
            axios.put('/api/topics/' + this.item.id, {
                title: this.item.title,
                content: this.item.content,
                show_time: this.item.show_time
            })
            .then( (res) => {
                this.editFlg = false;
                this.updated = true;
                console.log('update')
            })
            .catch(error => {
              console.info(error)
            })
        }
    }
}
</script>

<style lang="sass">
.card-text
  white-space: pre-wrap
</style>
