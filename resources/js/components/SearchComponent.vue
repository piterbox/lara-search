<template>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="mt-3 mb-3">Houses</h2>
        </div>
        <div class="row justify-content-center">
            {{name}}
            <div class="col-md-10 mt-3">
                <table class="table">
                    <thead>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Count of Bedrooms</th>
                        <th>Count of bathrooms</th>
                        <th>Count of Storeys</th>
                        <th>Count of Garages</th>
                    </thead>
                    <thead>
                    <th>
                        <input type="text"
                               v-model="name"
                               class="form-control"
                               value=""
                                @input="changeName"
                        >
                    </th>
                    <th>
                        <input type="text"
                               v-model="priceMin"
                               style="width: 47%; display: inline-block;"
                               class="form-control" value=""
                               placeholder="Min price"
                               @input="changePriceMin()"
                        >
                        <input type="text"
                               v-model="priceMax"
                               style="width: 47%; display: inline-block"
                               class="form-control" value=""
                               placeholder="Max price"
                               @input="changePriceMax()"
                        >
                    </th>
                    <th>
                        <select v-model="bedrooms" class="form-control" @change="selectBedrooms()">
                            <option value="" selected="bedrooms == null || garages == '' ? 'selected' : ''">Choose count</option>
                            <option value="1" selected="bedrooms == 1 ? 'selected' : ''">1</option>
                            <option value="2" selected="bedrooms == 2 ? 'selected' : ''">2</option>
                            <option value="3" selected="bedrooms == 3 ? 'selected' : ''">3</option>
                            <option value="4" selected="bedrooms == 4 ? 'selected' : ''">4</option>
                            <option value="5" selected="bedrooms == 5 ? 'selected' : ''">5</option>
                        </select>
                    </th>
                    <th>
                        <select v-model="bathrooms" class="form-control" @change="selectBathrooms()">
                            <option value="" selected="bathrooms == null || garages == '' ? 'selected' : ''">Choose count</option>
                            <option value="1" selected="bathrooms == 1 ? 'selected' : ''">1</option>
                            <option value="2" selected="bathrooms == 2 ? 'selected' : ''">2</option>
                            <option value="3" selected="bathrooms == 3 ? 'selected' : ''">3</option>
                            <option value="4" selected="bathrooms == 4 ? 'selected' : ''">4</option>
                            <option value="5" selected="bathrooms == 5 ? 'selected' : ''">5</option>
                        </select>
                    </th>
                    <th>
                        <select v-model="storeys" class="form-control" @change="selectStoreys()">
                            <option value="" selected="storeys == null || garages == '' ? 'selected' : ''">Choose count</option>
                            <option value="1" selected="storeys == 1 ? 'selected' : ''">1</option>
                            <option value="2" selected="storeys == 2 ? 'selected' : ''">2</option>
                        </select>
                    </th>
                    <th>
                        <select v-model="garages" class="form-control" @change="selectGarages()">
                            <option value="" selected="garages == null || garages == '' ? 'selected' : ''">Choose count</option>
                            <option value="1" selected="garages == 1 ? 'selected' : ''">1</option>
                            <option value="2" selected="garages == 2 ? 'selected' : ''">2</option>
                        </select>
                    </th>
                    </thead>
                    <tbody v-if="houses.length > 0 && !loader">
                    <tr v-for="house in houses">
                        <td>{{house.name}}</td>
                        <td>{{house.price}}</td>
                        <td>{{house.bedrooms}}</td>
                        <td>{{house.bathrooms}}</td>
                        <td>{{house.storeys}}</td>
                        <td>{{house.garages}}</td>
                    </tr>
                    </tbody>
                    <tbody class="text-center" v-else >
                        <tr>
                            <td colspan="6">
                                <h4 v-if="!loader">Not found</h4>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="6">
                                <h2 v-if="loader">
                                    <i class="fas fa-spinner fa-spin fs-2x"></i>
                                </h2>
                            </td>
                        </tr>

                    </tbody>


                </table>

            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    export default {
        data: function (){
            return {
                houses: [],
                name: '',
                priceMin: null,
                priceMax: null,
                bedrooms: null,
                bathrooms: null,
                storeys: null,
                garages: null,
                filter: {},
                error: false,
                loader: false

            }
        },
        mounted(){
            this.getFilterData();
        },
        methods:{
            getAllData(){
                this.loader = true;

                axios.post('/api/search')
                .then((response) => {
                    this.houses = response.data.houses;
                    this.loader = false;
                })
                .catch((error) => {console.log(error)});
             },
            getFilterData(){
                this.loader = true;

                axios.post('/api/search', this.filter)
                .then((response) => {
                    this.houses = response.data.houses;
                    this.loader = false;
                })
                .catch((error) => {console.log(error.message)});
            },
            changeName(){
                this.filter.name=this.name;
                this.getFilterData();
            },
            selectGarages(){
                this.filter.garages=this.garages;
                this.getFilterData();
            },
            selectStoreys(){
                this.filter.storeys=this.storeys;
                this.getFilterData();
            },
            selectBedrooms(){
                this.filter.bedrooms=this.bedrooms;
                this.getFilterData();
            },
            selectBathrooms(){
                this.filter.bathrooms=this.bathrooms;
                this.getFilterData();
            },
            changePriceMin(){
                this.filter.priceMin=this.priceMin;
                this.getFilterData();
            },
            changePriceMax(){
                this.filter.priceMax=this.priceMax;
                this.getFilterData();
            }
        }
    };
</script>
