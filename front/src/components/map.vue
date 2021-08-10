<template>
       <div>
              <input type="text" v-model="lr"/>
              <input type="text" v-model="rr"/>
              <button class="primary-btn" @click="hi">확인</button>
              <h1>위도{{ lr }} 경도 {{rr}}</h1>
        <div id="map" style="width:500px;height:400px;"></div>
       </div>
     
</template>

<script>
export default {
       data(){
              return{
                     lr:' ',
                     rr:'dkkd'
              }
       },
       computed:{
              go(){
                     return this.lr
              }
       },
     mounted() {
    if (window.kakao && window.kakao.maps) {
       this.hi()
      this.initMap()
     
    } else {
           console.log('aa')
      const script = document.createElement('script')
      script.onload = () => kakao.maps.load(this.initMap);
      script.src = 'http://dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=4b8bcafd1f73380351109f8a5f9d8518'
      document.head.appendChild(script)

   }
  },
  methods: {
    initMap () {
           console.log('aaaaaaa');
      const container = document.querySelector('#map')
      const options = {
        center: new kakao.maps.LatLng(35.19656853772262, 129.0807270648317),
        level: 3
      }
      const map = new kakao.maps.Map(container, options)
      const markerPosition = new kakao.maps.LatLng(35.19656853772262, 129.0807270648317);

      const marker = new kakao.maps.Marker({
        position: markerPosition
      });
      marker.setMap(map)
  } ,
  hi(){
         console.log('aaaa');
  }
}
}
</script>