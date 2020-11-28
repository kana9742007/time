<template>
  <div class="container">
    <div v-if="saved" class="alert alert-primary" role="alert">
    保存しました
    </div>
    <form>
      <div class="form-group">
        <label for="TopicTitle">タイトル</label>
        <input type="text" class="form-control" id="TopicTitle" v-model="title">
      </div>
      <div class="form-group">
        <label for="TopicContent">内容</label>
        <textarea class="form-control" id="TopicContent" rows="3" v-model="content"></textarea>
      </div>
      <div class="form-group">
        <label for="TopicTime">公開時間</label>
        <input type="datatime" class="form-control time" id="TopicTime" rows="3" v-model="show_time">
      </div>
      <button type="submit" class="btn btn-primary" @click.prevent="create">登録</button>
    </form>
  </div>
</template>

<script>
export default {
    data() {
        return {
            saved: false,
            title: '',
            content: '',
            show_time: '',
        }
    },
    methods: {
      create() {
        console.log(this.show_time);
        console.log((typeof this.show_time) )
        axios.post('/api/topics', {
          title: this.title,
          content: this.content,
          show_time: this.show_time,
        })
        .then((res) => {
          this.title = '';
          this.content = '';
          this.show_time = '';
          this.saved = true;
          console.log('created');
        })
        .catch(error => {
          console.info(error)
        })
      }
    }
}
</script>

<style lang="sass">
.form-group
  margin-bottom: 10px
  width: 80%
  label
    margin-bottom: 10px
    display: block
    font-weight: 700
    color: #696969
  .time
    width: 30%
  textarea,input
    display: block
    width: 90%
    padding: 15px
  .btn
    width: 150px
    padding: 5px 0px
    font-size: 16px
    cursor: pointers
</style>