<template>
    <nav class="panel column is-offset-2 is-8">
        <p class="panel-heading">
            Phonebook
            <button class="button is-link is-outlined" @click="open">
                Add New
            </button>
            <span class='is-pulled-right' v-if="loading">
                <i class="fa fa-refresh fa-spin fa-lg fa-fw"></i>
            </span>
        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
            <input class="input is-small" type="text" placeholder="search" v-model="searchQuery">
            <span class="icon is-small is-left">
                <i class="fa fa-search" aria-hidden="true"></i>
            </span>
            </p>
        </div>
        <ul v-if="errors">
            <li v-for="error in errors" :key="error.id">{{error}}</li>
        </ul>
        <a class="panel-block" v-for="contact,key in temp">
            <span class="column is-9">
                {{ contact.name }}
            </span>
            <span class='column is-1'>
                <i class="fa fa-trash has-text-danger" aria-hidden="true" @click="del(key,contact.id)"></i>
            </span>

            <span class='column is-1'>
                <i class="fa fa-edit has-text-primary" aria-hidden="true" @click="openEdit(key)"></i>
            </span>

            <span class='column is-1'>
	      <i class="has-text-primary fa fa-eye" aria-hidden="true" @click="openShow(key)"></i>
            </span>
        </a>

            <Add :openModal= 'addActive' @closeRequest='close'></Add>
	        <Show :openModal= 'showActive' @closeRequest='close'></Show>
            <Edit :openModal= 'editActive' @closeRequest='close'></Edit>
    </nav>

</template>

<script type="text/x-template">

import Add from './Add'
import Show from './Show'
import Edit from './Edit'

export default {
    components:{Add, Show, Edit},
    data() {
        return {
            addActive: '',
            showActive: '',
            editActive: '',
            searchQuery: '',
            temp: '',
            loading: false,
            contacts: {},
            errors: {},
        }
    },
    mounted() {
        axios.post('/getData').then((response) =>
            this.contacts = this.temp = response.data)
            .catch((error) => this.errors = error.response.data.errors)
    },
    watch: {
        searchQuery () {
            if(this.searchQuery.length > 0) {
                this.temp = this.contacts.filter((val) => {
                        return Object.keys(val).some((key) => {
                        let string = String(val[key])
                        return string.toLowerCase().indexOf(this.searchQuery.toLowerCase())>-1
                    })
                });
            } else {
                this.temp = this.contacts;
            }
        }
    },
    methods: {
        open() {
            this.addActive = 'is-active'
        },
        close() {
            this.addActive = this.showActive = this.editActive = ''
        },
        openShow(key){
            this.$children[1].contact = this.temp[key]
            this.showActive = 'is-active';
        },
        openEdit(key){
            this.$children[2].contact = this.temp[key]
            this.editActive = 'is-active';
        },
        del(key, id) {
            if(confirm('Are You Sure ?')) {
                this.loading = !this.loading
                axios.delete(`/phonebook/${id}`)
                .then((response) => {this.contacts.splice(key,1); this.loading = !this.loading})
                .catch((error) => this.errors = error.response.data.errors)
            }
        }
    }
}
</script>

