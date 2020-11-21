
<template>
    <v-img :src="campaign.image" class="black--text" width="50%">
        <v-card-title class="fill-height align-end" v-text="campaign.title">   
        </v-card-title>
    </v-img>
</template>>

<script>
    export default{
        mounted() {
            console.log('Component mounted. Campaign')
        }
    }
</script>

