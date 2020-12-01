<template>
  <div class="detai_content" v-if="item">
    <div  v-if="onAirTimeCheck" class="card_wrapp">
      <div class="card_body">
        <h1 class="card_title">{{item.title}}</h1>
        <div class="card_text">{{item.content}}</div>
      </div>
    </div>
    <div v-else class="diff_wrap">
      <div v-show="isShown" class="diff_body">
        <p>公開時間:　{{this.theHour}}：{{this.theMinute}}</p>
        <h1 class="diff_text">{{this.diffHour}}：{{this.diffMinute}}：{{this.diffSec}}</h1>
        <a class="btn-border" href="/">HOME</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
    data() {
        return {
          item: null,
          onAirTimeCheck: false,
          onAirTime: '',
          diffTime: '',
          diffHour: '',
          diffMinute: '',
          diffSec: '',
          theHour: '',
          theMinute: '',
          isShown: false,
          setTime: '',
          nowDateTimes: '',
        }
    },
    created() {
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
        this.goTime();
      },
      countTime(){
        this.nowDateTimes = new Date();  // 今の時間
        var nowFullYear = this.nowDateTimes.getFullYear();
        var nowMonth = this.nowDateTimes.getMonth();
        var nowDate = this.nowDateTimes.getDate();

        var thisTime = this.item.show_time;  // 目標時間
        this.theHour = thisTime.slice( 11, 13 );
        this.theMinute = thisTime.slice( 14, 16 );
        this.setTime = new Date(nowFullYear,nowMonth,nowDate,this.theHour,this.theMinute);
        // 計算
        this.diffTime = this.setTime - this.nowDateTimes;
        if(this.diffTime < 0){
          var addDayTime = Math.floor(this.diffTime + (60*60*24*1000));
          this.diffSec = Math.floor(addDayTime / (1000));
          this.diffHour = Math.floor(this.diffSec / (60*60));
          this.diffMinute = Math.floor((this.diffSec - this.diffHour*60*60) / 60);
          this.diffSec -= (this.diffHour * 60 * 60 + this.diffMinute * 60)
          this.isShown = true;
          this. openArticle();
        } else {
          this.diffSec = Math.floor(this.diffTime / (1000));
          this.diffHour = Math.floor(this.diffSec / (60*60));
          this.diffMinute = Math.floor((this.diffSec - this.diffHour*60*60) / 60);
          this.diffSec -= (this.diffHour * 60 * 60 + this.diffMinute * 60);
          this.isShown = true;
          this. openArticle();
        }
      },
      openArticle(){
        if(this.nowDateTimes > this.setTime && this.nowDateTimes < this.setTime.setHours(this.setTime.getHours()+1) ){
          this.onAirTimeCheck = true;
          if(this.onAirTimeCheck){
            console.log('open');
          }
        } else {
          this.onAirTimeCheck = false;
        }
      },
      goTime(){
        let self = this;
        setInterval(function() {
          self.countTime();
        }, 1000)
      },
    },
}
</script>

<style lang="sass">
.detai_content
  margin: 0
  overflow: hidden
  .card_wrapp
    width: 80%
    overflow-x: scroll
    max-width: 900px
    margin: 100px auto
    .card_body
      position: relative
      display: inline-block
      .card_title
        color: #696969
        font-size: 20px
        position: absolute
        right: 0px
        font-weight: bold
        letter-spacing: 1em
      .card_text
        padding-top: 60px
        // writing-mode: vertical-rl
        // text-orientation: upright
        // white-space: pre-wrap
        line-height: 2
        color: #696969
        font-size: 16px
        font-weight: 300
        letter-spacing: .2em
      .card_time
        // writing-mode: vertical-rl
        color: #696969
  .diff_wrap
    .diff_body
      margin-top: 10rem
      text-align: center
      transition: opacity 1s
      .diff_text
        margin: 5% 0px
        font-size: 10rem
        color: #DBDBDB
      .btn-border
        border-radius: 0
        margin: 0 auto
        position: relative
        padding: 10px 0px
        display: block
        width: 150px
        color: #DBDBDB
        -webkit-transition: all .3s
        transition: all .3s
        &:before
          top: 0
          left: 0
          position: absolute
          width: 100%
          height: 2px
          content: ''
          -webkit-transition: all .3s
          transition: all .3s
          background: #DBDBDB
        &:after
          right: 0
          bottom: 0
          position: absolute
          width: 100%
          height: 2px
          content: ''
          -webkit-transition: all .3s
          transition: all .3s
          background: #DBDBDB
        &:hover
          color: #707070
        &:hover:before,
        &:hover:after
          width: 0
          background: #707070

</style>
