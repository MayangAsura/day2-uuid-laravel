    <template>
        <div>
            <v-container class="ma-0 pa-0" grid-list-sm>

                <div class="text-right">
                    <v-btn small text to="/campaign" class="blue--text">
                        All Campaign <v-icon>mdi-chevron-right</v-icon>
                    </v-btn>
                </div>
                <div>
                    <v-layout wrap>
                        <v-flex v-for="campaign in campaigns" :key="'category-'+ campaign.id" xs6>
                            <v-card :to="'/campaign/' + campaign.index">
                                <v-img :src="campaign.image" class="black--text">
                                    <v-card-title class="fill-height align-end" v-text="campaign.title">   
                                    </v-card-title>
                                </v-img>
                            </v-card>
                        </v-flex>
                    </v-layout>

                </div>
                

            </v-container>
        </div>
    </template>

    <script>
        export default{
            
            data: () => ({
                campaigns: []
            }),
            created(){
                axios.get('api/campaign/random/2')
                    .then((response) => {
                        let {data} = response.data
                        this.campaigns = data.campaigns
                     
                    })
                    .catch((error) => {
                        let { response } = error
                        console.log(response)
                    })
            }
        }
    </script>