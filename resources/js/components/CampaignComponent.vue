
<template>
    <div>
        <v-card :to="'campaign/' + campaign.id">
            <v-img
                :src="campaign.image"
                class="black--text"
                height="200px">    
                <v-card-title
                    class="fill-height align-end"
                    v-text="campaign.title">
                </v-card-title>
            </v-img>

            <v-card-actions>
                <v-progress-linear
                    v-model="progress"
                    color="blue-grey"
                    height="7"
                >
                </v-progress-linear>
            </v-card-actions>

            <v-card-actions>
                <v-icon>mdi-cash</v-icon>
                <span>Rp {{ campaign.required.toLocaleString('id-ID')}} </span>
                <v-spacer></v-spacer>
                <span>{{progress}}% </span>
            </v-card-actions>

        </v-card>         
    </div>
</template>

<script>
    export default{
        // data: ()=>({
        //     name: 'campaign-component',
        //     props: ['campaign'],
        
        // }),
        name: 'campaign-component',
        props: ['campaign'],
        computed: {
            progress(){
                return (this.campaign.collected / this.campaign.required * 100)
            }
        },
        mounted() {
            console.log('Component mounted. Campaign')
        }
    }
</script>

    <!-- <v-img :src="campaign.image" class="black--text" width="50%">
        <v-card-title class="fill-height align-end" v-text="campaign.title">   
        </v-card-title>
    </v-img> -->

