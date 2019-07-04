<template>

<div class="modal" :class="openModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add New Contact</p>
      <button class="delete" aria-label="close" @click="close"></button>
    </header>
    <section class="modal-card-body">
      <div class="field">
        <label class="label">Name</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input" :class="{'is-danger':errors.name}" type="text" placeholder="Name" v-model='contact.name'>
          <span class="icon is-small is-left">
            <i class="fa fa-user"></i>
          </span>
        </div>
        <p v-if="errors.name" class="help is-danger">{{errors.name[0]}}</p>
      </div>

      <div class="field">
        <label class="label">Phone</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input" :class="{'is-danger':errors.phone}" type="number" placeholder="Phone" v-model="contact.phone">
          <span class="icon is-small is-left">
            <i class="fa fa-phone"></i>
          </span>
        </div>
        <p v-if="errors.phone" class="help is-danger">{{errors.phone[0]}}</p>
      </div>

      <div class="field">
        <label class="label">Email</label>
        <div class="control has-icons-left has-icons-right">
          <input class="input" :class="{'is-danger':errors.email}" type="email" placeholder="Email" v-model="contact.email">
          <span class="icon is-small is-left">
            <i class="fa fa-envelope"></i>
          </span>
        </div>
        <p v-if="errors.email" class="help is-danger">{{errors.email[0]}}</p>
      </div>
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" @click="add">Add</button>
      <button class="button" @click='close'>Cancel</button>
    </footer>
  </div>
</div>
</template>


<script>
export default {
    data() {
        return {
            contact: {
                name: '',
                phone: '',
                email: '',
            },
            errors: {},
        }
    },
    props:['openModal'],
    methods: {
        close() {
            this.$emit('closeRequest');
        },
        add() {
            axios.post('/phonebook', this.$data.contact)
            .then((response) => {
                this.close()
                this.contact.push(response.data)
            })
            .catch((error) => this.errors = error.response.data.errors)
        }
    }
}
</script>
