<template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
            <form class="space-y-4" @submit.prevent="submit">

                <div>
                    <label for="judul" class="block text-sm font-medium leading-6 text-gray-900">Judul</label>
                    <div class="mt-2">
                        <input id="judul" name="judul" type="text" v-model="judul" autocomplete="judul" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="penerbit" class="block text-sm font-medium leading-6 text-gray-900">Penerbit</label>
                    <div class="mt-2">
                        <input id="penerbit" name="penerbit" type="text" v-model="penerbit" autocomplete="penerbit" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="halaman" class="block text-sm font-medium leading-6 text-gray-900">Jumlah Halaman</label>
                    <div class="mt-2">
                        <input id="halaman" name="halaman" type="number" v-model="halaman" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <div class="flex items-center justify-between">
                        <label for="stok" class="block text-sm font-medium leading-6 text-gray-900">Stok</label>
                    </div>
                    <div class="mt-2">
                        <input id="stok" name="stok" type="number" v-model="stok"
                            autocomplete="stok" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Edit</button>
                </div>
            </form>
        </div>
    </div>

</template>

<script>
import axios from 'axios'


export default {
    data() {
        return {
            id: '',
            judul: '',
            penerbit: '',
            halaman: '',
            stok: '',
        };
    },
    methods: {
        getBookData(id) {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/books/' + id,
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    this.id = response.data.id
                    this.judul = response.data.judul
                    this.penerbit = response.data.penerbit
                    this.halaman = response.data.halaman
                    this.stok = response.data.stok

                }).catch(error => {
                    //set validation dari error response
                    this.judul = error.response.data
                })
        },
        submit() {
            let judul = this.judul
            let penerbit = this.penerbit
            let halaman = this.halaman
            let stok = this.stok

            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.put('/api/books/' + this.id,
                {
                    judul,
                    penerbit,
                    halaman,
                    stok
                },
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    //redirect ke halaman dashboard
                    this.$router.push('/book')

                }).catch(error => {
                    //set validation dari error response
                    this.validation = error.response.data
                })
        }
    },
    mounted() {
        this.getBookData(this.$route.params.id);
    }
};
</script>