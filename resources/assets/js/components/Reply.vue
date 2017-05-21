<script>
    import Favorite from './Favorite.vue';

    export default {
        props: ['attributes'],

        components: { Favorite},

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
            },

            destroy() {
                axios.delete('/posts/' + this.attributes.id);

                $(this.$el).slideUp(300, () => {
                    flash('Great! Tu comentario ha sido eliminado.');
                });
            }
        }
    }
</script>