<template>
    <div>
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation" @click="getOfferings">
                <a class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" href="#offering" role="tab"
                   aria-controls="offering" aria-selected="true">Offering</a>
            </li>
            <li class="nav-item" role="presentation" @click="getPurchases">
                <a class="nav-link" id="pills-profile-tab" data-bs-toggle="pill" href="#purchase" role="tab"
                   aria-controls="purchase" aria-selected="false">Purchase</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" href="#make-purchase" role="tab"
                   aria-controls="make-purchase" aria-selected="false">Make Purchase</a>
            </li>
        </ul>

        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="offering" role="tabpanel" aria-labelledby="offering">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="offering in offerings">
                        <th>{{offering.id}}</th>
                        <td>{{offering.title}}</td>
                        <td>
                            {{offering.quantity}}
                        </td>
                        <td>{{'$ ' + offering.price }}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="purchase" role="tabpanel" aria-labelledby="pills-profile-tab">

                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col">Title</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                        <th scope="col">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="purchase in purchases">
                        <th>{{purchase.id}}</th>
                        <th>{{purchase.customer_name}}</th>
                        <td>{{purchase.title}}</td>
                        <td>{{purchase.quantity}}</td>
                        <td>{{'$ ' + purchase.price}}</td>
                        <td>{{'$ ' + purchase.total}}</td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <div class="tab-pane fade" id="make-purchase" role="tabpanel" aria-labelledby="pills-profile-tab">
                <div>
                    <form  class="text-center mb-4">
                        <input type="text" placeholder="Enter your name" v-model="customerName" class="mr-3 p-2">
                        <button type="button" class="btn btn-lg btn-primary" @click="makePurchase(offerings)"> Make Purchase
                            {{(total)?('$ ' + total):('$ 0')}}
                        </button>

                    </form>
                    <div class="text-danger text-center mb-4">
                        {{error}}
                    </div>

                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Items</th>
                        <th scope="col">Title</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="offering in offerings" v-bind:key="offering.id">
                        <td>
                            <input v-if="offering.quantity" type="checkbox" v-model="offering.checked"
                                   @change="setTotal">
                        </td>
                        <td>
                            {{offering.title}}

                        </td>
                        <td v-if="offering.quantity">
                            <select v-model.number="offering.selectedQuantity"
                                    @change="setTotal"
                                    class="min-width-50"
                            >
                                <option v-for="quantity in offering.quantity">
                                    {{quantity}}
                                </option>
                            </select>
                        </td>
                        <td v-else class="text-danger">
                            Sold
                        </td>
                        <td>{{'$ ' + offering.price}}</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios';
    import _ from 'lodash'

    export default {
        name: "Home",
        data() {
            return {
                customerName: null,
                offerings: [],
                purchases: [],
                total: "",
                selectedOfferings: [],
                error: null
            }
        },
        computed: {},
        methods: {

            setTotal() {
                this.total = 0;
                this.selectedOfferings = [];
                _.each(this.offerings, item => {
                    if (item.checked) {
                        this.selectedOfferings.push(item);
                        this.total += item.selectedQuantity * item.price;
                    }
                })
            },

            makePurchase() {
                this.error = '';
                if (this.customerName && this.selectedOfferings.length) {

                    return axios.post('/create-purchase', {
                        data: JSON.stringify({offerings: this.selectedOfferings, customer_name: this.customerName})

                    })
                        .then((response) => {
                            this.selectedOfferings = [];
                            this.offerings = response.data;
                            this.total = 0;
                            this.customerName = null;

                            _.each(this.offerings, function (item) {
                                item.selectedQuantity = 1;
                                item.checked = false;
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                        })
                }

                if(!this.customerName){
                    return this.error = 'Customer name is required';
                }else if(!this.selectedOfferings.length){
                    return this.error = 'Please select item';
                } else{
                    this.error = 'Something went wrong';
                }

                setTimeout(()=>{this.error = ''},3000);
            },

            getPurchases() {
                axios.get('/get-purchases').then((response) => {
                    this.purchases = response.data;
                });
            },
            getOfferings() {
                axios.get('/get-offerings').then((response) => {
                    this.offerings = response.data;

                    //TODO check if quantity 0 add logic
                    _.each(this.offerings, function (item) {
                        item.selectedQuantity = 1;
                        item.checked = false;
                    });

                });
            }
        },
        mounted() {
            this.getOfferings();
        }
    }
</script>

<style scoped>

    .min-width-50 {
        min-width: 50px;
    }

    button {
        vertical-align: inherit;
    }
</style>