<style scoped>
.container {
    margin-top: 20px;
}
</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="navigation_left">
                    <v-select
                        class="p-2"
                        :options="restaurants"
                        placeholder="Select restaurants"
                        @input="selectRestaurant($event)"
                    ></v-select>
                </div>
                <div v-if="show">
                    <!-- <v-card class="mx-left" max-width="344" outlined>
                        <v-list-item three-line>
                            <v-list-item-content>
                                <div class="text-overline mb-4">{{ daraRes.name }}</div>
                                <v-list-item-title class="text-h5 mb-1">
                                    {{ daraRes.formatted_address }}
                                </v-list-item-title>
                                <v-list-item-subtitle
                                    >Greyhound divisely hello coldly
                                    fonwderfully</v-list-item-subtitle
                                >
                            </v-list-item-content>

                            <v-list-item-avatar
                                tile
                                size="80"
                                color="grey"
                            ></v-list-item-avatar>
                        </v-list-item>

                        <v-card-actions>
                            <v-btn outlined rounded text> Button </v-btn>
                        </v-card-actions>
                    </v-card> -->
                    <v-card
                        :loading="loading"
                        class="mx-auto my-12"
                        max-width="374"
                    >
                        <template slot="progress">
                            <v-progress-linear
                                color="deep-purple"
                                height="10"
                                indeterminate
                            ></v-progress-linear>
                        </template>

                        <v-img
                            height="250"
                            :src="img"
                        ></v-img>

                        <v-card-title>{{dataRes.name}}</v-card-title>

                        <v-card-text>
                            <v-row align="center" class="mx-0">
                                <v-rating
                                    :value="4.5"
                                    color="amber"
                                    dense
                                    half-increments
                                    readonly
                                    size="14"
                                ></v-rating>

                                <div class="grey--text ms-4">{{dataRes.rating}}</div>
                            </v-row>

                            <div class="my-4 text-subtitle-1 d-flex" >

                                {{dataRes.type}}
                            </div>

                            <div>
                            {{dataRes.formatted_address}}
                            </div>
                        </v-card-text>
                        <v-card-text>
                            <v-chip-group
                                active-class="deep-purple accent-4 white--text"
                                column
                            >
                                <v-chip v-if="selection === 1">OPEN</v-chip>
                                <v-chip v-if="selection === 0">CLOSE</v-chip>
                            </v-chip-group>
                        </v-card-text>
                    </v-card>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Vue from "vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
Vue.component("v-select", vSelect);
export default {
    name: "RestaurantsComponent",
    props: [],
    data() {
        return {
            restaurants: [],
            dataForProcess: [],
            search: "",
            dataRes: [],
            show: false,
            loading: false,
            selection: 0,
            img: "",
            key:'',
            // AKR5kUgAiU3MuOf3fPt_-ZXh-zHzM4_SgXYu5B4tedi4ZOItIGrtPbOjN_OGJxi12uOv9uVglAyaQePNm8E-0N-yq-icWGHGLALNtGY=s1600-w400

            // https://lh3.googleusercontent.com/places/AKR5kUgAiU3MuOf3fPt_-ZXh-zHzM4_SgXYu5B4tedi4ZOItIGrtPbOjN_OGJxi12uOv9uVglAyaQePNm8E-0N-yq-icWGHGLALNtGY=s1600-w400
        };
    },
    mounted() {
        // console.log("Component mounted.");
        fetch("http://127.0.0.1:8000/api/restaurants")
            .then((response) => response.json())
            .then((data) => {
                this.dataForProcess = data.results;
                this.key = data.key;
                data.results.forEach((item, index) => {
                    // has access to outer scope `parentMessage`
                    // but `item` and `index` are only available in here
                    this.restaurants.push({ id: index, label: item.name });
                });
                
            });
    },
    methods: {
        selectRestaurant(event) {
            this.dataRes = this.dataForProcess[event.id];
            if (this.dataRes) {
                console.log(this.dataRes);
                this.show = true;
                this.loading = true;
                this.img = "https://maps.googleapis.com/maps/api/place/photo?maxwidth=400&photo_reference=" +this.dataRes.photos[0].photo_reference + "&key="+this.key;
                if(this.dataRes.opening_hours){
                    this.selection = this.dataRes.opening_hours.open_now ? 1 : 0;
                }
            }
        },
    },
};
</script>
