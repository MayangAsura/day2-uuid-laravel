    <template>
        <div>
           <v-card v-if="campaign.id">
               <v-img :src="campaign.image" class="white--text" height="200px">
                    <v-card-title class="fill-height align-end" v-text="campaign.title"></v-card-title>
               </v-img>

               <v-card-text>
                   <v-simple-table dense>
                       <tbody>
                           <tr>
                               <td><v-icon>mdi-home-city</v-icon>Alamat </td>
                               <td>{{campaign.address}} </td>
                           </tr>
                           <tr>
                               <td><v-icon>mdi-hand-heart</v-icon>Terkumpul </td>
                               <td class="blue--text">Rp {{campaign.collected.toLocaleString('id-ID')}} </td>
                           </tr>
                           <tr>
                               <td><v-icon>mdi-cash</v-icon>Dibutuhkan </td>
                               <td class="orange--text">Rp {{campaign.required.toLocaleString('id-ID')}} </td>
                           </tr>
                       </tbody>
                   </v-simple-table>
                   Description: <br> {{campaign.description }}
               </v-card-text>

               <v-card-action>
                   <v-btn block color="primary" @click="donate" :disabled="campaign.collected >= campaign.required"> 
                       <v-icon>mdi-money</v-icon> &nbsp; Donate
                   </v-btn><br>
                   <v-btn block color="secondary" @click="undo" :disabled="campaign.collected >= campaign.required"> 
                       <v-icon>mdi-money</v-icon> &nbsp; Undo
                    </v-btn>
               </v-card-action>
           </v-card>
        </div>
    </template>


<script>
    import { mapMutations, mapActions } from 'vuex'
    
    export default{

        data: () => ({
                campaign: {},   
            }),

        created(){
            this.go()
        },
        methods: {
            ...mapMutations({
                tambahTransaksi : 'transaction/increment',
                undoTransaksi : 'transaction/decrement'
            }),
            ...mapActions({
                setAlert: 'alert/set'
            }),
            donate(){
                this.tambahTransaksi()
                this.setAlert({
                    status: true,
                    color: 'success',
                    text: "Transaksi berhasil ditambahkan"
                })
            },
            undo(){
                this.undoTransaksi()
                this.setAlert({
                    status: true,
                    color: 'success',
                    text: "Transaksi berhasil dikurangi"
                })
            },
            go(){
                let {id} = this.$route.params
                let url = '/api/campaign/'+id
                axios.get(url).then((response) => {
                    let {data} = response.data
                    this.campaign = data.campaign
                })
                .catch((error) => {
                    let { responses } = error
                    console.log(responses)
                })
            },
            
        }
    }
    </script>