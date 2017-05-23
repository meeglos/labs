<script>
    import Posts from '../components/Posts.vue';

    export default {
        props: ['initialPostsCount'],

        components: { Posts },

        data() {
            return {
                postsCount: this.initialPostsCount
            };
        }
    }
</script>