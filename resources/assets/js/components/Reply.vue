<script>
    export default {
        props: ['attributes'],

        data() {
            return {
                editing: false,
                comments: this.attributes.comments
            };
        },

        methods: {
            update() {
                axios.patch('/posts/' + this.attributes.id, {
                   comments: this.comments
                });

                this.editing = false;

                flash('Comentario actualizado!');
            }
        }
    }
</script>