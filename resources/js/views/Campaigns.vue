

<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <v-subheader>All campaign</v-subheader>

            <v-layout wrap>
                <v-flex v-for="campaign in campaigns" :key="'campaign-'+ campaign.id" xs4>
                    <!-- <v-card :to="'/campaign/' + campaign.index"> -->
                        <!-- <v-img :src="campaign.image" class="black--text" width="50%">
                            <v-card-title class="fill-height align-end" v-text="campaign.title">   
                            </v-card-title>
                        </v-img> -->

                        <campaign-component :campaign="campaign"></campaign-component>
                        
                    <!-- </v-card> -->
                </v-flex>
            </v-layout>

            <v-pagination
                v-model="page"
                @input="go"
                :length="lengthPage"
                :total-visible="6"
            >

            </v-pagination>
        </v-container>
    </div>
</template>
 
 
 <script>
        // import CampaignComponent from '../components/CampaignComponent'
        
        export default{
            
            data: () => ({
                campaigns: [],
                page: 0,
                lengthPage: 0
            }),
            components: {
                CampaignComponent:() => import('../components/CampaignComponent')
            },
            created(){
                this.go()
            },
            methods: {
                go(){
                    let url = 'api/campaign?page=' + this.page
                    axios.get(url)
                    .then((response) => {
                        let {data} = response.data
                        this.campaigns = data.campaigns.data
                        this.page = data.campaigns.current_page
                        this.lengthPage = data.campaigns.last_page
                    })
                    .catch((error) => {
                        let {responses} = error
                        console.log(responses)
                    })
                }
            }
        }
    </script>