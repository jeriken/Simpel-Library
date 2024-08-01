<template>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">Selamat Datang {{ userData.name }}</div>
        </div>

        <div class="grid grid-cols-3 gap-4 mt-4">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Jumlah Anggota: {{ dashData.users }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Jumlah Buku: {{ dashData.books }}</div>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">Jumlah Peminjaman: {{ dashData.pinjams }}</div>
            </div>
        </div>
    </div>


</template>
<script>
import axios from 'axios'


export default {
    data() {
        return {
            userData: '',
            dashData: ''
        };
    },
    methods: {
        getUserData() {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/profile',
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    if (response.data) {
                        this.userData = response.data
                    }

                }).catch(error => {
                    //set validation dari error response
                    this.userData = error.response.data
                })
        },
        getDashboardData() {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/dashboard',
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    if (response.data) {
                        this.dashData = response.data
                    }

                }).catch(error => {
                    //set validation dari error response
                    this.userData = error.response.data
                })
        }
    },
    mounted() {
        this.getUserData();
        this.getDashboardData();
    }
};
</script>