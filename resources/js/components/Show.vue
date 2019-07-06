<template>

<div class="modal" :class="openModal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Add New Contact</p>
      <button class="delete" aria-label="close" @click="close"></button>
    </header>
    <section class="modal-card-body">
      <div class="panel-block">
        <label class="label column is-2"><b>Name</b></label> {{contact.name}}
      </div>

      <div class="panel-block">
        <label class="label column is-2"><b>Phone</b></label> {{contact.phone}}
      </div>
      <div class="panel-block">
        <label class="label column is-2"><b>Email</b></label> {{contact.email}}
      </div>

    </section>
    <footer class="modal-card-foot">
      <button class="button" @click='close'>Cancel</button>
    </footer>
  </div>
</div>
</template>


<script type="text/x-template">
export default {
    data() {
        return {
            contact: '',
        }
    },
    props:['openModal'],
    methods: {
        close() {
            this.$emit('closeRequest');
        },
    }
}
</script>
