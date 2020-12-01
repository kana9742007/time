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
        <input type="time" class="form-control time" id="TopicTime" rows="3" v-model="show_time">
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
            changeTime: '',
        }
    },
    methods: {
      create() {
        var toDay = new Date();
        var year = String(toDay.getFullYear());
        var month = String("0"+(toDay.getMonth() + 1)).slice(-2);
        var day = String("0"+toDay.getDate()).slice(-2);
        var fixTime = String(this.show_time.replace(":" ,""));
        this.changeTime = year + month + day + fixTime + '00';
        console.log(this.changeTime);
        axios.post('/api/topics', {
          title: this.title,
          content: this.content,
          show_time: this.changeTime,
        })
        .then((res) => {
          this.title = '';
          this.contents = '';
          this.show_time = '';
          this.saved = true;
          console.log('created');
        })
        .catch(error => {
          console.info(error)
        })
      },

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