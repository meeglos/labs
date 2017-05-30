<template>
    <button :class="classes" @click="subscribe">
        <small><span :class="classname"></span></small>
        <span v-text="name"></span>
    </button>
</template>

<script>
    export default {
        props: ['active'],

        computed: {
            name() {
                return this.active ? 'Suscrito' : 'Suscríbete';
            },

            classes() {
                return ['btn', this.active ? 'btn-danger' : 'btn-primary'];
            },

            classname() {
                return ['glyphicon', this.active ? 'glyphicon-remove' : 'glyphicon-ok'];
            }
        },

        methods: {
            subscribe() {
                axios[
                    (this.active ? 'delete' : 'post')
                    ](location.pathname + '/subscriptions');

                this.active = ! this.active;
            }
        }
    }
</script>