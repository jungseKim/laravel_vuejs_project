<template>
  <div id="app">
         <input v-model="search"/>
         <v-btn @click="moveMap">확인</v-btn>
         <v-tab></v-tab>
    <div id="map"></div>
  </div>
</template>

<script>
export default {
       data(){
              return{
                     search:'',
                     map:null,
                     Places:null
              }
       },
    mounted() {
        if (window.kakao && window.kakao.maps) {
            this.initMap();
        } else {
            const script = document.createElement('script');

            script.onload = () => kakao.maps.load(this.initMap);
            script.src = 'http://dapi.kakao.com/v2/maps/sdk.js?autoload=false&appkey=4b8bcafd1f73380351109f8a5f9d8518&&libraries=services';
            document.head.appendChild(script);
        }
    },
    methods: {
        initMap() {
            var container = document.getElementById('map');
            var options = {
              center: new kakao.maps.LatLng(33.450701, 126.570667),
              level: 3
            };

            this.map = new kakao.maps.Map(container, options);
            //실제 화면 
       //      this.map.setMapTypeId(kakao.maps.MapTypeId.HYBRID);
            
            this.Places= new kakao.maps.services.Places();
        },
         moveMap(){
              // let ps = new kakao.maps.services.Places();
              console.log(this.Places)
              this.Places.keywordSearch(this.search, this.placesSearchCB); 
              this.search='';
           },
        placesSearchCB (data, status,) {
                     if (status === kakao.maps.services.Status.OK) {

                            // 검색된 장소 위치를 기준으로 지도 범위를 재설정하기위해
                            // LatLngBounds 객체에 좌표를 추가합니다
                            var bounds = new kakao.maps.LatLngBounds();

                            for (var i=0; i<data.length; i++) {
                            // displayMarker(data[i]);    
                            bounds.extend(new kakao.maps.LatLng(data[i].y, data[i].x));
                            }       

                            // 검색된 장소 위치를 기준으로 지도 범위를 재설정합니다
                            this.map.setBounds(bounds);
                     } 
                 }
    },
}
</script>

<style>
#map {
    width: 400px;
    height: 300px;
}
</style>