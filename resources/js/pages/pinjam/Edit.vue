<template>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
            <form class="space-y-4" @submit.prevent="submit">

                <div>
                    <label for="user_id" class="block text-sm font-medium leading-6 text-gray-900">Peminjam</label>
                    <div class="mt-2">
                        <select id="user_id" name="user_id" v-model="user_id" autocomplete="user_id" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" selected>Pilih peminjam</option>
                            <option v-for="user in userData" :value="user.id">{{ user.name }}</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="book_id" class="block text-sm font-medium leading-6 text-gray-900">Buku</label>
                    <div class="mt-2">
                        <select id="book_id" name="book_id" v-model="book_id" autocomplete="book_id" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="" selected>Pilih buku</option>
                            <option v-for="book in bookData" :value="book.id">{{ book.judul }} - {{ book.stok }} buku
                                tersisa</option>
                        </select>
                    </div>
                </div>

                <div>
                    <label for="date_pinjam" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                        Pinjam</label>
                    <div class="mt-2">
                        <input id="date_pinjam" name="date_pinjam" type="datetime-local" v-model="date_pinjam" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div v-if="status == 'Dikembalikan'">
                    <label for="date_retur" class="block text-sm font-medium leading-6 text-gray-900">Tanggal
                        Pengembalian</label>
                    <div class="mt-2">
                        <input id="date_retur" name="date_retur" type="datetime-local" v-model="date_retur"
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                    </div>
                </div>

                <div>
                    <label for="status" class="block text-sm font-medium leading-6 text-gray-900">Status</label>
                    <div class="mt-2">
                        <select id="status" name="status" v-model="status" autocomplete="status" required
                            class="block w-full rounded-md border-0 p-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6">
                            <option value="Belum Dikembalikan">Belum Dikembalikan</option>
                            <option value="Dikembalikan">Dikembalikan</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Ubah</button>
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
            bookData: [],
            userData: [],
            id: '',
            user_id: '',
            book_id: '',
            date_pinjam: '',
            date_retur: '',
            status: '',
        };
    },
    methods: {
        getPinjamData(id) {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/pinjam/' + id,
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    this.id = response.data.id
                    this.user_id = response.data.user_id
                    this.book_id = response.data.book_id
                    this.date_pinjam = response.data.date_pinjam?.slice(0, -3)
                    this.date_retur = response.data.date_retur?.slice(0, -3);
                    this.status = response.data.status

                }).catch(error => {
                    //set validation dari error response
                    this.judul = error.response.data
                })
        },
        getBookData() {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/books/stok',
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {
                    this.bookData = response.data
                }).catch(error => {
                    //set validation dari error response
                    this.bookData = error.response.data
                })
        },
        getUserData() {
            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.get('/api/users/',
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {
                    this.userData = response.data
                }).catch(error => {
                    //set validation dari error response
                    this.userData = error.response.data
                })
        },
        submit() {
            let id = this.id
            let user_id = this.user_id
            let book_id = this.book_id
            let date_pinjam = this.date_pinjam
            let date_retur = (this.status == 'Dikembalikan') ? this.date_retur : null
            let status = (this.status == 'Dikembalikan') ? 1 : 0

            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.put('/api/pinjam/' + id,
                {
                    user_id,
                    book_id,
                    date_pinjam,
                    date_retur,
                    status
                },
                {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Authorization': token
                    }
                })
                .then(response => {

                    //redirect ke halaman dashboard
                    this.$router.push('/pinjam')

                }).catch(error => {
                    //set validation dari error response
                    this.validation = error.response.data
                })
        }
    },
    mounted() {
        this.getPinjamData(this.$route.params.id);
        this.getUserData();
        this.getBookData();
    }
};
</script>