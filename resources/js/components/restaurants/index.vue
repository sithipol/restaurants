<style scoped>
.ul li {
  color: red;
}
</style>
<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <input
                    type="text"
                    v-model="search"
                    placeholder="Search people..."
                /><br />

                {{ getAllRestaurantInBangSue() }}

                <ul>
                    <li v-for="(restaurant, index) in filteredRestaurants" :key="index">
                        {{ restaurant.name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "RestaurantsComponent",

    data() {
        return {
            restaurants: [],
            search: "",
        };
    },
    mounted() {
        console.log("Component mounted.");
    },
    methods: {
        getAllRestaurantInBangSue() {
            fetch("http://127.0.0.1:8000/api/restaurants")
                .then((response) => response.json())
                .then((data) => {
                    this.restaurants = data.results;
                });
        },
    },
    computed: {
        filteredRestaurants: function () {
            return this.restaurants.filter((restaurant) => {
                return restaurant.name.match(this.search);
            });
        },
    },
};
</script>
