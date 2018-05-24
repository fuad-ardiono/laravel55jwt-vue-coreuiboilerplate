<template>
    <div class="app">
        <AppHeader/>
        <div class="app-body">
            <Sidebar :navItems="nav"/>
            <main class="main">
                <breadcrumb :list="list"/>
                <div class="container-fluid">
                    <router-view></router-view>
                </div>
            </main>
            <AppAside/>
        </div>
        <AppFooter/>
    </div>
</template>

<script>
    import Axios from 'axios';
    import nav from '../_nav';
    import {Header as AppHeader, Sidebar, Aside as AppAside, Footer as AppFooter, Breadcrumb} from '../components/';

    export default {
        name: 'full',
        components: {
            AppHeader,
            Sidebar,
            AppAside,
            AppFooter,
            Breadcrumb
        },
        data() {
            return {
                nav: nav.items
            };
        },
        computed: {
            name() {
                return this.$route.name;
            },
            list() {
                return this.$route.matched;
            }
        },
        beforeUpdate() {
            Axios.get('/api/validate')
                .then((res) => {

                })
                .catch((err) => {
                    this.$router.push({path: '/'});
                    Cookies.remove('name', { path: '' });
                    console.log(err);
                });
        }
    };
</script>
