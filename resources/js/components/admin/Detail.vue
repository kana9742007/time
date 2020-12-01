<template>
  <div>
    <div class="card" v-if="item">
      <div class="card-body">
        <div v-if="!editFlg">
          <h1 class="card_title">タイトル：{{item.title}}</h1>
          <div class="card_text">本文：{{item.content}}</div>
          <div class="card_text">公開時間：{{theHour}}:{{theMinute}} </div>
        </div>
        <form v-else>
          <div class="form-group">
            <input type="text" name="title" id="TopicTitle" class="form-control" v-model="item.title">
          </div>
          <div class="form-group">
            <textarea name="content" id="TopicContent" class="form-control" v-model="item.content"></textarea>
          </div>
          <div class="form-group">
            <input type="time" name="show_time" id="TopicTime" class="form-control" v-model="item.show_time">
          </div>
        </form>
      </div>
      <div class="card-footer">
        <button class="btn btn-light" v-if="!editFlg" @click="(editFlg = true)">編集</button>
        <button class="btn btn-light" v-else @click="onUpdate">更新</button>
        <button class="btn btn-light add-left" @click="checkDetail">確認</button>
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
          changeTime: '',
          fixTime: '',
          theHour: '',
          theMinute: '',
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
              this.replaseTime(this.item);
          })
          .catch(error => {
            console.info(error)
          })
        },
        replaseTime(item){
          var thisTime = item.show_time;  // 目標時間
          console.log(thisTime);
          this.theHour = thisTime.slice( 11, 13 );
          this.theMinute = thisTime.slice( 14, 16 );
        },
        setTime(){
          var toDay = new Date();
          var year = String(toDay.getFullYear());
          var month = String("0"+(toDay.getMonth() + 1)).slice(-2);
          var day = String("0"+toDay.getDate()).slice(-2);
          this.fixTime = String(this.item.show_time.replace(":" ,""));
          this.changeTime = year + month + day + this.fixTime + '00';
        },
        onUpdate() {
          this.setTime();
          axios.put('/api/topics/' + this.item.id, {
              title: this.item.title,
              content: this.item.content,
              show_time: this.changeTime
          })
          .then( (res) => {
              this.editFlg = false;
              this.$router.go({path: this.$router.currentRoute.path, force: true})
              console.log('update')
          })
          .catch(error => {
            console.info(error)
          })
        },
        checkDetail(){
          this.setTime();
          axios.put('/api/topics/' + this.item.id, {
              title: this.item.title,
              content: this.item.content,
              show_time: this.changeTime
          })
          .then( (res) => {
              this.editFlg = false;
              console.log('update')
          })
          .catch(error => {
            console.info(error)
          })
          var thisUrl = location.href;
          var nexttUrl  = thisUrl.replace("admin/detail/","");
          window.location = nexttUrl;
        }
    }
}
</script>

<style lang="sass">
.card-body
  width: 80%
  max-width: 900px
  margin: 0 auto
  position: relative
  display: inline-block
  .card_title
    color: #696969
    font-size: 20px
    font-weight: bold
  .card_text
    padding-top: 20px
    white-space: pre-wrap
    line-height: 2
    color: #696969
    font-size: 16px
    font-weight: 300
    letter-spacing: .2em
  .card_time
    color: #696969
.card-footer
  display: flex
  margin-top: 10px
  .add-left
    margin-left: 10px
</style>
