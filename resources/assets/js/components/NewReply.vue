<template>
    <div>
        <div v-if="signedIn">
            <div class="form-group">
                <textarea name="comments" id="comments" rows="3" class="form-control" placeholder="Escriba su comentario" v-model="comments" required></textarea>
            </div>

            <button type="submit" class="btn btn-primary form-control"
                    @click="addReply">Guardar
            </button>
        </div>
        <p class="text-center" v-else>
            Por favor <a href="/login">regístrese</a> para poder comentar.
        </p>
    </div>
</template>

<script>
    export default {
        props: ['endpoint'],

        data() {
            return {
                comments: ''
            };
        },

        computed: {
            signedIn() {
                return window.App.signedIn;
            }
        },

        methods: {
            addReply() {
                axios.post(this.endpoint, { comments: this.comments })
                    .then(({data}) => {
                        this.comments = '';

                        flash('Tu comentario ha sido guardado.');

                        this.$emit('created', data);
                    });
            }
        }
    }
</script>