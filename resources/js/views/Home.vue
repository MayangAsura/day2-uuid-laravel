    <template>
        <div>   
            <v-container class="ma-0 pa-0" grid-list-sm>
                <div class="text-right">
                    <v-btn small text to="/campaigns" class="blue--text">
                        All Campaign <v-icon>mdi-chevron-right</v-icon>
                    </v-btn>
                </div>
                <div>
                    <v-layout wrap>
                        <v-flex v-for="campaign in campaigns" :key="'campaign-'+ campaign.id" xs6>
    
                                <campaign-component :campaign="campaign"></campaign-component>

                        </v-flex>
                    </v-layout>
                </div>   
            </v-container>

            <v-container class="ma-0 pa-0" grid-list-sm>
                <div class="text-right">
                    <v-btn small text to="/blogs" class="blue--text">
                        All Blogs <v-icon>mdi-chevron-right</v-icon>
                    </v-btn>
                    <v-layout wrap>
                        <v-carousel hide-delimeters height="300px">
                            <v-carousel-item v-for="blog in blogs" :key="'blog-'+blog.id">
                                <v-img :src="blog.image" class="fill-height">
                                    <v-container fill-height fluid pa-0 ma-0>
                                        <v-layout fill-height align-end>
                                            <v-flex xs12 ms-2>
                                                <span class="headline black--text" v-text="blog.title"></span>
                                            </v-flex>
                                        </v-layout>
                                    </v-container>
                                </v-img>
                            </v-carousel-item>
                        </v-carousel>
                    </v-layout>
                </div>
            </v-container>
        </div>
    </template>


    <script> 
        export default{
            data: () => ({
                campaigns: {},
                blogs: []
            }),
            components: {
                CampaignComponent:() => import('../components/CampaignComponent')
            },
            created(){
                axios.get('api/campaign/random/2')
                    .then((response) => {
                        let {data} = response.data
                        this.campaigns = data.campaigns
                        console.log(this.campaigns)
                    })
                    .catch((error) => {
                        let { response } = error
                        console.log(response)
                    })

                axios.get('api/blog/random/2')
                    .then((response) => {
                        let {data} = response.data
                        this.blogs = data.blogs
                    })
                    .catch((error) => {
                        let {response} = error
                        console.log(response)
                    })
            },
            mounted() {
                console.log('Component mounted. Home')
            }
        }
    </script>