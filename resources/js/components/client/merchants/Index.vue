<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header rtl">البائعين</div>

                    <div class="card-body">


                          <b-card-group deck v-for="(chunk, index) in chunkedItems" :key="index" class="mb-3">
                              <b-card v-for="merchant in chunk" :key="merchant.id"
                                no-body
                                tag="article"
                                class="mb-2 rtl"
                            >
                                <b-card-body>
                                <b-card-title>{{merchant.name}}</b-card-title>
                                    <b-card-text>
                                    أوقات العمل من: {{ merchant.opens_at }} إلى {{ merchant.closes_at }}
                                    </b-card-text>

                                    <b-card-text>
                                    عدد الواقفين: {{ merchant.in_line }}
                                    </b-card-text>

                                    <b-alert v-if="merchant.bookings.length" variant="success" show>
                                        لقد حجزت، رقمك هو #{{ merchant.bookings[0].number }}
                                        لقد حجزت، رقمك هو #{{ merchant.bookings[0].date }}
                                        <b-button href="#" variant="danger" @click="cancel(merchant.bookings[0])">الغاء</b-button>
                                    </b-alert>
                                    <b-button href="#" variant="primary" @click="book(merchant.id)" v-else>حجز</b-button>

                                </b-card-body>

                                <b-card-footer>
                                    <i class="fa fa-phone"></i>
                                    {{ merchant.phone }}
                                </b-card-footer>
                            </b-card>
                          </b-card-group>


                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                merchants: []
            }
        },
        mounted() {
            console.log('Component mounted.')

            this.getMerchants();
        },
        methods: {
            book(merchantId) {
                axios.post(`/api/v1/client/merchants/${merchantId}/bookings`)
                    .then(response => {
                        this.getMerchants();
                    })
                    .catch(error => {
                        console.log(error)
                    })

            },
            getMerchants() {
                axios.get('/api/v1/client/merchants') // auth!
                    .then(response => {
                        this.merchants = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            cancel(booking) {
                axios.delete(`/api/v1/client/bookings/${booking.id}`)
                    .then(response => {
                        this.getMerchants();
                    })
                    .catch(error => {
                        //
                    })
            }
        },
        computed: {
            chunkedItems () {
                return _.chunk(this.merchants,2)
            }
        }
    }
</script>
