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
                            <option v-for="book in bookData" :value="book.id">{{ book.judul }} - {{ book.stok }} buku tersisa</option>
                        </select>
                    </div>
                </div>

                <div>
                    <button type="submit"
                        class="flex w-full justify-center rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-semibold leading-6 text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Tambah</button>
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
            user_id: '',
            book_id: '',
        };
    },
    methods: {
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
            let user_id = this.user_id
            let book_id = this.book_id
            let date_pinjam = new Date()

            let token = 'Bearer ' + localStorage.getItem('token')

            //send server with axios
            axios.post('/api/pinjam',
                {
                    user_id,
                    book_id,
                    date_pinjam
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
        this.getUserData();
        this.getBookData();
    }
};
</script>