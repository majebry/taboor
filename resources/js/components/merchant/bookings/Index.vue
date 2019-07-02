<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8 col-12">
                <div class="card">
                    <div class="card-header">الحجوزات</div>

                    <div class="card-body">

                        <div class="list-group" v-if="bookings.length">
                            <div class="list-group-item" v-for="(booking, index) in bookings" :key="index">
                                    {{ booking.client.name + ' #' + booking.number }}
                                <template v-if="index == 0">
                                    <b-button href="#" variant="success" @click="done(booking)">إتمام المعاملة</b-button>
                                    <b-button href="#" variant="warning" @click="cancel(booking)">إلغاء الحجز</b-button>
                                </template>
                            </div>
                        </div>
                        <b-alert variant="warning" v-else show>لا يوجد بيانات</b-alert>

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
                bookings: []
            }
        },
        mounted() {
            console.log('Component mounted.')

            this.getBookings();
        },
        created() {

            Echo.channel('taboor')
                .listen('ClientBooked', (e) => {
                    this.getBookings();
                });

        },
        methods: {
            getBookings() {
                axios.get('/api/v1/merchant/bookings')
                    .then(response => {
                        this.bookings = response.data
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            done(booking) {
                axios.post(`/api/v1/merchant/bookings/${booking.id}/dealing`)
                    .then(response => {
                        this.getBookings();
                    })
                    .catch(error => {
                        console.log(error)
                    })
            },
            cancel(booking) {
                axios.delete(`/api/v1/merchant/bookings/${booking.id}`)
                    .then(response => {
                        this.getBookings();
                    })
                    .catch(error => {
                        //
                    })
            }
        }
    }
</script>
