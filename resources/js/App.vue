<template>

    <!-- Note: COMPONENT V-* dibuat oleh VUETIFY -->
    <v-app >
        <alert></alert>

        <keep-alive>
            <v-dialog v-model="dialog" fullscreen hide-overlay persistent transition="dialog-bottom-transition">
                <component :is="currentComponent" @closed="setDialogStatus"></component>
            </v-dialog>
        </keep-alive>


        <!-- <v-dialog v-model="dialog" fullscreen hide-overlay transition="scale-transition">
            <search @closed="closeDialog"></search>
        </v-dialog> -->
        <!-- DRAWER = BUKA/TUTUP -->
        <v-navigation-drawer app v-model="drawer">
              <v-list>
                <v-list-item v-if="!guest">

                    <v-list-item-avatar>
                        <v-img :src="user.user.photo"></v-img>
                        <!-- <v-img src="https://randomuser.me/api/portraits/men/78.jpg"></v-img> -->
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>{{user.user.name}} </v-list-item-title>
                    </v-list-item-content>

                </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn block color="primary" class="mb-1" @click="setDialogComponent('login')">
                        <v-icon left>mdi-lock</v-icon>
                        Login
                    </v-btn>
                    <v-btn block color="success">
                        <v-icon left>mdi-account</v-icon>
                        Register
                    </v-btn>
                </div>

                <v-divider></v-divider>

                <v-list-item
                    v-for="(item, index) in menus"
                    :key="`menu-`+index"
                    :to="item.route"
                >
                    <v-list-item-icon>
                        <v-icon left> {{item.icon}} </v-icon>
                    </v-list-item-icon>
                    <v-list-item-content>
                        <v-list-item-title> {{item.title}} </v-list-item-title>
                    </v-list-item-content>

                </v-list-item>
            </v-list>

            <template v-slot:append v-if="!guest">
                <div class="pa-2">
                    <v-btn block color="red" dark @click="logout">
                        <v-icon left> mdi-lock</v-icon>
                        Logout
                    </v-btn>
                </div>
            </template>
            

        </v-navigation-drawer>

        <v-app-bar app color="#407899" dark v-if="isHome">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Khadijah Crowdfunding App</v-toolbar-title>

            <v-spacer></v-spacer>
            <v-btn icon>
                <v-badge color="orange" overlap v-if="transaction > 0">
                    <template v-slot:badge >
                        <span>{{ transaction}} </span>
                        <!-- <span>{{ $store.state.count}} </span> -->
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
                    <v-icon v-else>mdi-cash-multiple</v-icon>
            </v-btn>

            <v-text-field
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                flat
                label="Search"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
                @click="setDialogComponent('search')"
            >
            </v-text-field>
        </v-app-bar>

        <v-app-bar app color="#407899" dark v-else>
            <v-btn icon @click.stop="$router.go(-1)">
                <v-icon>mdi-arrow-left-circle</v-icon>
            </v-btn>

            <v-spacer></v-spacer>

            <v-spacer></v-spacer>
            <v-btn icon>

                <v-badge color="orange" overlap  v-if="transaction > 0">
                    <template v-slot:badge >
                        <span>{{ transaction }} </span>
                        <!-- <span>{{$store.state.count }} </span> -->
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
                <v-icon v-else>mdi-cash-multiple</v-icon>
            </v-btn>
        </v-app-bar>

        <v-main>
            <v-container fluid>
                <v-slide-y-transition>
                    <router-view></router-view>
                </v-slide-y-transition>
            </v-container>
        </v-main>

        <v-card>
            <v-footer absolute app>
                <v-card-text class="text-center">
                    &copy;{{ new Date().getFullYear() }} - KhadijahApp
                </v-card-text>
            </v-footer>
        </v-card>
    </v-app>
</template>

<script>
    import { mapActions, mapGetters } from 'vuex'

    export default{
        name: 'App',
        components: {
            Alert: ()=> import('./components/Alert'),
            Search: ()=> import('./components/Search'),
            Login: ()=> import('./components/Login')
        },
        data: () => ({
            drawer: true,
            menus: [
                { title: 'Home', icon: 'mdi-home', route: '/' },
                { title: 'Campaign', icon: 'mdi-hand-heart', route: '/campaigns' },
            ],
          
            // guest: false,
            // dialog: false
            // snackbarStatus: false,
            // snackbarText: 'Transaksi berhasil ditambahkan'
        }),
        computed: {
            isHome(){
                return (this.$route.path === '/' || this.$route.path === '/home')
            },
            //AKSES VIA MAPGETTERS PAKAI MODULE (nama_module/nama_getters)
            ...mapGetters({
                transaction : 'transaction/transaction',
                guest : 'auth/guest',
                user : 'auth/user',
                dialogStatus: 'dialog/status',
                currentComponent: 'dialog/component'
            }),
            dialog:{
                get(){
                    return this.dialogStatus
                },
                set(value){
                    this.setDialogStatus(value)
                }
            }
            //AKSES VIA MAPGETTERS TANPA MODULE
            // ...mapGetters({
            //     'transaction' : 'transaction'
            // })
            //AKSES LANGSUNG VIA GETTERS
            // transaction(){
            //     return this.$store.getters.transaction
            //     return this.$store.getters.count
            // }
        },
        methods:{
            ...mapActions({
                setDialogStatus: 'dialog/setStatus',
                setDialogComponent: 'dialog/setComponent',
                setAuth: 'auth/set',
                setAlert: 'alert/set',
                checkToken: 'auth/checkToken'
            }),
            logout(){
                let config = {
                    headers: {
                        'Authorization' : 'Bearer ' + this.user.token
                    }
                }
                axios.post('/api/logout', {}, config)
                .then((response) => {
                    this.setAuth({}) //kosongkan auth
                    this.setAlert({
                        status: true,
                        color: 'success',
                        text: 'Logout berhasil'
                    })
                    
                }).catch((error) =>{
                    let {data} = error.response
                    this.setAlert({
                        status: true,
                        color: 'error',
                        text: data.message
                    })
                })
            }
            // closeDialog(value){
            //     this.dialog = value
            // }
        },
        mounted(){

            if(this.user){
                this.checkToken(this.user)
            }
        }
    }
</script>
