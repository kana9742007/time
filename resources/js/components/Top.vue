<template lang="">
  <div class="top_wrapper">
    <div class="top_container">
      <h1>TIME</h1>
      <div v-if="!timeFlag" class="no-title">
        <p>公開記事はありません</p>
      </div>
      <div v-if="timeFlag" class="time_list">
        <div @click="goLink(item.id)" class="item" v-for="item in setItems" :key="item.id">
          <p>{{item.set_time}}</p>
          <p>{{item.title}}</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import moment from "moment";
export default {
  data() {
      return {
        items: [],
        setItems: [],
        timeFlag: false,
        updated: false,
        item: null,
        count: 0,
      }
  },
  mounted() {
    this.getItems();
  },
  methods: {
    getItems() {
      axios.get('/api/topics/')
      .then( (res) => {
        this.items = res.data.data;
        console.log(this.items);
        this.fetch();
      });
    },
    fetch(){
      var date = new Date();
      var newDate = moment(date).format('HH:mm');
      var addDate = moment(date).add(1, 'hour').format('HH:mm');
      console.log(newDate);
      console.log(addDate);
      for(const item of this.items){
        const thisTime = item.show_time;
        const setTime = moment(thisTime).format('HH:mm');
        const setAddTime = moment(thisTime).add(1, 'hour').format('HH:mm');
        this.items[this.count].set_time = setTime;
        if(newDate >= setTime && addDate >= setAddTime){
          this.timeFlag = true;
          this.setItems.push(item);
          console.log(this.setItems);
        }
        this.count ++;
      }
      console.log(this.nowDateTimes);
    },
    goLink(id){
      window.location.href="/"+id
    }
  },
}
</script>

<style lang="sass">
.top_wrapper
  @keyframes fadein-bottom
    0%
      opacity: 0
      transform: translateY(20px)
    100%
      opacity: 1
      transform: translateY(0)
  .top_container
    text-align: center
    h1
      margin-top: 10rem
      font-size: 15rem
      color: #DBDBDB
      animation-name: fadein-bottom
      animation-duration: 1.5s
      animation-timing-function: ease-out
      animation-fill-mode: forwards
    p
      color: #696969
  .time_list
    width: 500px
    margin: 50px auto 0px
    animation-name: fadein-bottom
    animation-duration: 1.5s
    animation-timing-function: ease-out
    animation-fill-mode: forwards
    animation-delay: .5s
    opacity: 0
    .item
      display: flex
      justify-content: space-between
      margin-bottom: 15px
      padding-bottom: 8px
      color: #696969
      cursor: pointer
      position: relative
      &:after
        left: 0
        bottom: 0
        position: absolute
        width: 0
        height: 1px
        content: ''
        -webkit-transition: all .3s
        transition: all .3s
        background: #DBDBDB
      &:hover:after
        width: 100%
        background: #707070
      &:last-child
        margin-bottom: 0px
</style>
