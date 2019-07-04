<template>
    <nav class="panel column is-offset-2 is-8">
        <p class="panel-heading">
            Phonebook
            <button class="button is-link is-outlined" @click="open">
                Add New
            </button>
        </p>
        <div class="panel-block">
            <p class="control has-icons-left">
            <input class="input is-small" type="text" placeholder="search">
            <span class="icon is-small is-left">
                <i class="fa fa-search" aria-hidden="true"></i>
            </span>
            </p>
        </div>
        <ul v-if="errors">
            <li v-for="error in errors" :key="error.id">{{error}}</li>
        </ul>
        <a class="panel-block" v-for="contact in contacts" :key="contact.id">
            <span class="column is-9">
                {{ contact.name }}
            </span>
            <span class='column is-1'>
                <i class="fa fa-trash has-text-danger" aria-hidden="true"></i>
            </span>

            <span class='column is-1'>
                <i class="fa fa-edit has-text-primary" aria-hidden="true"></i>
            </span>

            <span class='column is-1'>
                <i class="fa fa-eye has-text-dark" aria-hidden="true"></i>
            </span>
        </a>

            <Add :openModal= 'addActive' @closeRequest='close'></Add>
    </nav>

</template>

<script>

import Add from './Add'

export default {
    components:{Add},
    data() {
        return {
            addActive: '',
            contacts: {},
            errors: {},
        }
    },
    mounted() {
        axios.get('/getData').then((response) =>
            this.contacts = response.data)
            .catch((error) => this.errors = error.response.data.errors)
    },
    methods: {
        open() {
            this.addActive = 'is-active'
        },
        close() {
            this.addActive = ''
        },
    }
}
</script>

