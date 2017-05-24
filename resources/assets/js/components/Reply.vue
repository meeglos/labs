<template>
    <div id="'post-'+id" class="panel panel-default">
        <div class="panel-heading">
            <a :href="'/profiles/'+attributes.owner.name"
               v-text="attributes.owner.name">
            </a> comentó <span v-text="ago"></span>

            <span class="pull-right" v-if="signedIn">
                <favorite :post="attributes"></favorite>
            </span>

            <span class="pull-right" v-if="canUpdate">
                <button class="btn btn-warning btn-xs btn-ml-5" @click="editing = true">Editar</button>
            </span>

            <span class="pull-right" v-if="canUpdate">
                <button class="btn btn-danger btn-xs" @click="destroy">Borrar</button>
            </span>
        </div>

        <div class="panel-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea v-model="comments" class="form-control" rows="2"></textarea>
                </div>

                <button class="btn btn-xs btn-info" @click="update">Actualizar</button>

                <button class="btn btn-xs btn-link" @click="editing = false">Cancelar</button>
            </div>

            <div v-else v-text="comments"></div>
        </div>
    </div>
</template>

<script>
    import Favorite from './Favorite.vue';
    import moment from 'moment';

    export default {
        props: ['attributes'],

        components: { Favorite },

        data() {
            return {
                editing: false,
                id: this.attributes.id,
                comments: this.attributes.comments
            };
        },

        computed: {
            ago() {
                moment.locale('es');
                return moment(this.attributes.created_at).fromNow() + ' ...';
            },

            signedIn() {
                return window.App.signedIn;
            },

            canUpdate() {
                return this.authorize(user => this.attributes.user_id == user.id);
//                return this.attributes.user_id == window.App.user.id;
            }
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

                flash('Comentario eliminado!');

                this.$emit('deleted', this.attributes.id);

            }
        }
    }
</script>