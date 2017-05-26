<script>
    import Posts from '../components/Posts.vue';
    import SubscribeButton from '../components/SubscribeButton.vue';

    export default {
        props: ['initialPostsCount'],

        components: { Posts, SubscribeButton },

        data() {
            return {
                postsCount: this.initialPostsCount
            };
        }
    }
</script>